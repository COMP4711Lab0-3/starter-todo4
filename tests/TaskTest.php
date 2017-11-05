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

    // task tests

    public function testTaskMaxLength65(){
      $value = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
      $this->task->setTask($value);
      $this->assertNotEquals($value, $this->task->task);
    }

    public function testTaskMaxLength64(){
      $value = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
      $this->task->setTask($value);
      $this->assertEquals($value, $this->task->task);
    }

    public function testTaskEmpty(){
      $value = "";
      $this->task->setTask($value);
      $this->assertNotEquals($value, $this->task->task);
    }

    public function testTaskString(){
      $value = "Task";
      $this->task->setTask($value);
      $this->assertEquals($value, $this->task->task);
    }

    public function testTaskStringSpace(){
      $value = "Task Creation";
      $this->task->setTask($value);
      $this->assertEquals($value, $this->task->task);
    }

    public function testTaskStringInt(){
      $value = "2";
      $this->task->setTask($value);
      $this->assertEquals($value, $this->task->task);
    }

    public function testTaskInt(){
      $value = 2;
      $this->task->setTask($value);
      $this->assertNotEquals($value, $this->task->task);
    }

    // priority tests

    public function testPriorityString(){
      $value = "priority";
      $this->task->setPriority($value);
      $this->assertNotEquals($value, $this->task->priority);
    }

    public function testPriorityIntInRangeMin(){
      $value = 1;
      $this->task->setPriority($value);
      $this->assertEquals($value, $this->task->priority);
    }

    public function testPriorityIntInRangeMax(){
      $value = 4;
      $this->task->setPriority($value);
      $this->assertEquals($value, $this->task->priority);
    }

    public function testPriorityIntOutOfRangeAbove(){
      $value = 5;
      $this->task->setPriority($value);
      $this->assertNotEquals($value, $this->task->priority);
    }

    public function testPriorityIntOutOfRangeBelow(){
      $value = 0;
      $this->task->setPriority($value);
      $this->assertNotEquals($value, $this->task->priority);
    }

    public function testPriorityDouble(){
      $value = 2.0;
      $this->task->setPriority($value);
      $this->assertNotEquals($value, $this->task->priority);
    }

    // size tests

    public function testSizeString(){
      $value = "Size";
      $this->task->setSize($value);
      $this->assertNotEquals($value, $this->task->size);
    }

    public function testSizeIntInRangeMin(){
      $value = 1;
      $this->task->setSize($value);
      $this->assertEquals($value, $this->task->size);
    }

    public function testSizeIntInRangeMax(){
      $value = 4;
      $this->task->setSize($value);
      $this->assertEquals($value, $this->task->size);
    }

    public function testSizeIntOutOfRangeAbove(){
      $value = 5;
      $this->task->setSize($value);
      $this->assertNotEquals($value, $this->task->size);
    }

    public function testSizeIntOutOfRangeBelow(){
      $value = 0;
      $this->task->setSize($value);
      $this->assertNotEquals($value, $this->task->size);
    }

    public function testSizeDouble(){
      $value = 2.0;
      $this->task->setSize($value);
      $this->assertNotEquals($value, $this->task->size);
    }

    // group tests

    public function testGroupString(){
      $value = "Group";
      $this->task->setGroup($value);
      $this->assertNotEquals($value, $this->task->group);
    }

    public function testGroupIntInRangeMin(){
      $value = 1;
      $this->task->setGroup($value);
      $this->assertEquals($value, $this->task->group);
    }

    public function testGroupIntInRangeMax(){
      $value = 5;
      $this->task->setGroup($value);
      $this->assertEquals($value, $this->task->group);
    }

    public function testGroupIntOutOfRangeAbove(){
      $value = 6;
      $this->task->setGroup($value);
      $this->assertNotEquals($value, $this->task->group);
    }

    public function testGroupIntOutOfRangeBelow(){
      $value = 0;
      $this->task->setGroup($value);
      $this->assertNotEquals($value, $this->task->group);
    }

    public function testGroupDouble(){
      $value = 2.0;
      $this->task->setGroup($value);
      $this->assertNotEquals($value, $this->task->group);
    }
}