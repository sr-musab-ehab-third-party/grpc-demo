<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: logs.proto

namespace App\Proto\GPBMetadata;

class Logs
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�

logs.protologs"3
Log
level (	
message (	
data (	")

LogRequest
logEntry (2	.logs.Log"
LogResponse
result (	2=

LogService/
WriteLog.logs.LogRequest.logs.LogResponseB$�	App\\Proto�App\\Proto\\GPBMetadatabproto3'
        , true);

        static::$is_initialized = true;
    }
}
