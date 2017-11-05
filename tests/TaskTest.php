<?php

if (! class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

class TaskTest extends PHPUnit_Framework_TestCase {

    private $CI;
    private $task;

    public function setUp() {
      // Load CI instance normally
      $this->CI = &get_instance();
      $this->task = new Task;
    }

    public function testTaskCreation() {
      $this->task->task = "task Creation";
      assertNotEquals("taskCreation", $task->task);
    }
}