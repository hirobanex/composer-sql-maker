<?php

use uchiko\SQL\Maker;

class InsertTest extends PHPUnit_Framework_TestCase {


    // driver sqlite
    public function testDriverSqliteHashColumn() {

        $builder = new Maker(array('driver' => 'sqlite'));

        $values = array();
        $values['bar'] = 'baz';
        $values['john'] = 'man';
        $values['created_on'] = array("datetime('now')");
        $values['updated_on'] = array("datetime(?)", "now");

        list($sql, $binds) = $builder->insert('foo', $values);
        $this->assertEquals("INSERT INTO \"foo\"\n(\"bar\", \"john\", \"created_on\", \"updated_on\")\nVALUES (?, ?, datetime('now'), datetime(?))", $sql);
        $this->assertEquals('baz,man,now', implode(',', $binds));

    }

    public function testDriverSqliteArrayColumn() {

        $builder = new Maker(array('driver' => 'sqlite'));

        $values = array();
        $values[] = array('bar'  => 'baz');
        $values[] = array('john' => 'man');
        $values[] = array('created_on' => array("datetime('now')"));
        $values[] = array('updated_on' => array("datetime(?)", "now"));

        list($sql, $binds) = $builder->insert('foo', $values);
        $this->assertEquals("INSERT INTO \"foo\"\n(\"bar\", \"john\", \"created_on\", \"updated_on\")\nVALUES (?, ?, datetime('now'), datetime(?))", $sql);
        $this->assertEquals('baz,man,now', implode(',', $binds));

    }

    public function testInsertIgnoreHash() {

        $builder = new Maker(array('driver' => 'sqlite'));

        $values = array();
        $values['bar'] = 'baz';
        $values['john'] = 'man';
        $values['created_on'] = array("datetime('now')");
        $values['updated_on'] = array("datetime(?)", "now");

        $opt = array();
        $opt['prefix'] = 'INSERT IGNORE';

        list($sql, $binds) = $builder->insert('foo', $values, $opt);
        $this->assertEquals("INSERT IGNORE \"foo\"\n(\"bar\", \"john\", \"created_on\", \"updated_on\")\nVALUES (?, ?, datetime('now'), datetime(?))", $sql);
        $this->assertEquals("baz,man,now", implode(',', $binds));

    }

    public function testInsertIgnoreArray() {

        $builder = new Maker(array('driver' => 'sqlite'));

        $values = array();
        $values[] = array('bar'  => 'baz');
        $values[] = array('john' => 'man');
        $values[] = array('created_on' => array("datetime('now')"));
        $values[] = array('updated_on' => array("datetime(?)", "now"));

        $opt = array();
        $opt['prefix'] = 'INSERT IGNORE';

        list($sql, $binds) = $builder->insert('foo', $values, $opt);
        $this->assertEquals("INSERT IGNORE \"foo\"\n(\"bar\", \"john\", \"created_on\", \"updated_on\")\nVALUES (?, ?, datetime('now'), datetime(?))", $sql);
        $this->assertEquals("baz,man,now", implode(',', $binds));

    }


    // driver mysql
    public function testDriverMysqlHash() {

        $builder = new Maker(array('driver' => 'mysql'));

        $values = array();
        $values['bar']  = 'baz';
        $values['john'] = 'man';
        $values['created_on'] = array('NOW()');
        $values['updated_on'] = array('FROM_UNIXTIME(?)', 1302536204);

        list($sql, $binds) = $builder->insert('foo', $values);
        $this->assertEquals("INSERT INTO `foo`\n(`bar`, `john`, `created_on`, `updated_on`)\nVALUES (?, ?, NOW(), FROM_UNIXTIME(?))", $sql);
        $this->assertEquals('baz,man,1302536204', implode(',', $binds));

    }

    public function testDriverMysqlArray() {

        $builder = new Maker(array('driver' => 'mysql'));

        $values = array();
        $values[] = array('bar'  => 'baz');
        $values[] = array('john' => 'man');
        $values[] = array('created_on' => array('NOW()'));
        $values[] = array('updated_on' => array('FROM_UNIXTIME(?)', 1302536204));

        list($sql, $binds) = $builder->insert('foo', $values);
        $this->assertEquals("INSERT INTO `foo`\n(`bar`, `john`, `created_on`, `updated_on`)\nVALUES (?, ?, NOW(), FROM_UNIXTIME(?))", $sql);
        $this->assertEquals('baz,man,1302536204', implode(',', $binds));

    }

    public function testDriverMysqlInsertIgnoreHash() {

        $builder = new Maker(array('driver' => 'mysql'));

        $values = array();
        $values['bar']  = 'baz';
        $values['john'] = 'man';
        $values['created_on'] = array('NOW()');
        $values['updated_on'] = array('FROM_UNIXTIME(?)', 1302536204);

        $opt = array();
        $opt['prefix'] = 'INSERT IGNORE';

        list($sql, $binds) = $builder->insert('foo', $values, $opt);
        $this->assertEquals("INSERT IGNORE `foo`\n(`bar`, `john`, `created_on`, `updated_on`)\nVALUES (?, ?, NOW(), FROM_UNIXTIME(?))", $sql);
        $this->assertEquals("baz,man,1302536204", implode(',', $binds));

    }

    public function testDriverMysqlInsertIgnoreArray() {

        $builder = new Maker(array('driver' => 'mysql'));

        $values = array();
        $values[] = array('bar'  => 'baz');
        $values[] = array('john' => 'man');
        $values[] = array('created_on' => array('NOW()'));
        $values[] = array('updated_on' => array('FROM_UNIXTIME(?)', 1302536204));

        $opt = array();
        $opt['prefix'] = 'INSERT IGNORE';

        list($sql, $binds) = $builder->insert('foo', $values, $opt);
        $this->assertEquals("INSERT IGNORE `foo`\n(`bar`, `john`, `created_on`, `updated_on`)\nVALUES (?, ?, NOW(), FROM_UNIXTIME(?))", $sql);
        $this->assertEquals("baz,man,1302536204", implode(',', $binds));

    }

}






