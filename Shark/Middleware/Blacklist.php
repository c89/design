<?php
/**
 * Slim Blacklist Middleware
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
 * Blacklist Middleware
 *
 * This middleware blacklists ip addresses to restrict
 * access to the Slim application
 */
class Blacklist extends \Slim\Middleware
{
    /**
     * @var callable
     */
     protected $callable;

     /**
      * @var blacklisted array
      */
     protected $blacklisted = array();

    /**
     * Constructor
     * @param callable $callable
     */
    public function __construct($blacklisted = array(), $callable = null)
    {
        if (!is_array($blacklisted)) {
            throw new \InvalidArgumentException('argument blacklisted must be an array');
        } else {
            $this->blacklisted = $blacklisted;
        }

        if (null === $callable) {
            $this->callable = array($this, 'defaultBlacklistedPage');
        } else {
            if (!is_callable($callable)) {
                throw new \InvalidArgumentException('argument callable must be callable');
            } else {
                $this->callable = $callable;
            }
        }
    }

    /**
     * Call
     */
    public function call()
    {
        $env = $this->app->environment();
        if (in_array($env['REMOTE_ADDR'], $this->blacklisted)) {
            call_user_func($this->callable);
        } else {
            $this->next->call();
        }
    }

    /**
     * Add an ip to the blacklisted ip array
     * @param string $ip - must be a valid IPv4 address
     */
    public function blacklist($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('argument must be a valid IPv4 address');
        } else {
            $this->blacklisted[] = $ip;
        }
    }

    /**
     * Default Blacklisted callback
     */
    public function defaultBlacklistedPage()
    {
        $env = $this->app->environment();
        $body = "<html><head><title>Not allowed</title><style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{display:inline-block;width:65px;}</style></head><body><h1>Not Allowed</h1><p>" . sprintf('IP %s is not allowed.', $env['REMOTE_ADDR']) . "</p></body></html>";
        $this->app->contentType('text/html');
        $this->app->response()->status(403);
        $this->app->response()->body($body);
    }
} 