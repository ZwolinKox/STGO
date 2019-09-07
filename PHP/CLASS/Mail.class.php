<?php

class Mail {
    protected $to;
    protected $subject;
    protected $message;
    protected $additionalHeaders;
    protected $additionalParametrs;

    public function __construct($to, $subject, $message, $additionalHeaders = null, $additionalParametrs = null) {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->additionalHeaders = $additionalHeaders;
        $this->additionalParametrs = $additionalParametrs;
    }

    public function getTo() {
        return $this->to;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getAdditionalHeaders() {
        return $this->additionalHeaders;
    }

    public function getAdditionalParametrs() {
        return $this->additionalParametrs;
    }

    public function setTo($value) {
        $this->to = $value;
    }

    public function setSubject($value) {
        $this->subject = $value;
    }

    public function setMessage($value) {
        $this->message = $value;
    }

    public function setAdditionalHeaders($value) {
        $this->additionalHeader = $values;
    }

    public function setAdditionalParametrs($value) {
        $this->additionalParametrs = $value;
    }

    public function send() {
        mail($this->to, $this->subject, $this->message);
    }
}