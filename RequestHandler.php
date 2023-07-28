<?php
class RequestHandler
{
  /**
   * Get URI elements.
   *
   * @return array
   */
  public static function getUriSegments()
  {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);
    return $uri;
  }

  /**
   * Get querystring params.
   *
   * @return array
   */
  public static function getQueryStringParams()
  {
    parse_str($_SERVER['QUERY_STRING'], $params);
    return $params;
  }

  /**
   * Send 404 response.
   */
  public static function sendNotFoundResponse()
  {
    header("HTTP/1.1 404 Not Found");
    exit();
  }
}
?>