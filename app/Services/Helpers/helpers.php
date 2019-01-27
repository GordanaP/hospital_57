<?php

/**
 * Respond to an if statement.
 *
 * @param  string $value1
 * @param  string $value2
 * @param  string $response
 * @return string
 */
function getIfStat($value1, $value2, $response)
{
    return $value1 == $value2 ? $response : '';
}

/**
 * Get the active class.
 *
 * @param  string $value1
 * @param  string $value2
 * @return string
 */
function getActiveClass($value1, $value2)
{
    return $value1 == $value2 ? 'active' : '';
}

/**
 * Get the selected option.
 *
 * @param  string $value1
 * @param  string $value2
 * @return string
 */
function getSelected($value1 , $value2)
{
    return $value1 == $value2 ? 'selected' : '';
}

/**
 * Get the checked option.
 *
 * @param  string $value1
 * @param  string $value2
 * @return string
 */
function getChecked($value1 , $value2)
{
    return $value1 == $value2 ? 'checked' : '';
}

/**
 * Get an alert message.
 *
 * @param  string $message
 * @param  string $type
 * @return array
 */
function getAlert($message, $type)
{
    $alert['message'] = $message;
    $alert['type'] = $type;

    return $alert;
}