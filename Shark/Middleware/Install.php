<?php
/**
 * Slim Install Middleware
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Shark\Middleware;

/**
 * Install Middleware
 *
 * This middleware adds a simple web installer to your Slim applications.
 * It will first look for a lock file, in case it doesn't exist will show 
 * the installer template. Once the form is submited it runs your own callback
 * and creates the lock file to avoid showing the install template again.
 *
 * The default template will display a form with some basic database fields,
 * such as database host, name or password. You can set your own template for
 * more control.
 *
 * To set an error in the installer form use the Flash's middleware flashNow.
 */
class Install extends \Slim\Middleware
{
    /**
     * @var settings
     */
    protected $settings = array('lock'=>'install.lock');

    /**
     * @var callable
     */
    protected $callable;

    /**
     * constructor - initialize the middleware
     * settings:
     *  template    - installer's form template
     *  redirect    - redirect after successful callback
     *  lock        - if the lock file exists the script is already installed
     * @param array $settings
     * @param callable $callback
     */
    public function __construct($settings = array(), $callback)
    {
        $this->settings = array_merge($this->settings, $settings);
        $this->callback = $callback;
    }

    /**
     * call
     */
    public function call()
    {
        if (!isset($this->app->environment['slim.flash'])) {
            throw new \RunTimeException('Flash middleware must be added after the Install middleware');
        }

        if (file_exists($this->settings['lock'])) {
            $this->next->call();
        } else {
            $lockFolder = dirname($this->settings['lock']);
            if (!is_writable($lockFolder)) {
                $this->app->flashNow('install.lock_file_is_not_writable', realpath($lockFolder) . ' must be writable');
            }

            if ($this->app->request->isPost()) {
                if (!is_callable($this->callback)) {
                     throw new \InvalidArgumentException('argument callable must be callable');
                 } else {
                    call_user_func($this->callback);
                    if (count($this->app->environment['slim.flash']) === 0 && touch($this->settings['lock'])) {
                        if (headers_sent() === false) {
                            if(isset($this->settings['redirect'])) {
                                $url = $this->settings['redirect'];
                            } else {
                                $url = $this->app->request()->getScriptName();
                            }
                            header('Location: ' . $url);
                            exit;
                        }
                    }
                }
            }

            $this->app->view()->setData('flash', $this->app->environment['slim.flash']);
            $this->app->contentType('text/html');
            $this->app->response()->status(200);

            if (!isset($this->settings['template'])) {
                $this->app->view->setTemplatesDirectory(__DIR__ . DIRECTORY_SEPARATOR . 'templates');
                $this->app->response()->body($this->app->view->fetch('default.php'));
            } else {
                $this->app->response()->body($this->app->view->fetch($this->settings['template']));
            }
        }
    }
}
