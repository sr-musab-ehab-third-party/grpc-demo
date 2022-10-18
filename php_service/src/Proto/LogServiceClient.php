<?php
// GENERATED CODE -- DO NOT EDIT!

namespace App\Proto;

/**
 */
class LogServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \App\Proto\LogRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function WriteLog(\App\Proto\LogRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/logs.LogService/WriteLog',
        $argument,
        ['\App\Proto\LogResponse', 'decode'],
        $metadata, $options);
    }

}
