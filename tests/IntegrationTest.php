<?php
namespace PhilipBrown\Mars\Tests;

use PHPUnit\Framework\TestCase;
use PhilipBrown\Mars\Application\Command;
use PhilipBrown\Mars\Application\ContainerBuilder;


class IntegrationTest extends TestCase
{
    /** @var Command */
    private $command;

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function setUp()
    {
        $container = (new ContainerBuilder())->build_container();

        $this->command = $container->get('command');
    }

    /**
     * Tests grid location is changed by commands
     */
    public function testMovement()
    {
        $this->command->set_rover_location(1,2,'N');
        $this->command->interpret_string_command('LMLMLMLMM');
        $position =  $this->command->get_rover_location();
        $this->assertEquals('1 3 N',$position);
        $this->assertNotEquals('2 3 N',$position);

        $this->command->set_rover_location(3,3,'E');
        $this->command->interpret_string_command('MMRMMRMRRM');
        $position =  $this->command->get_rover_location();
        $this->assertEquals('5 1 E',$position);
        $this->assertNotEquals('5 1 S',$position);
    }

    /**
     * Test grid and rover locations have default values
     */
    public function testDefaultValues()
    {
        $position =  $this->command->get_rover_location();
        $this->assertEquals('0 0 N',$position);

        $this->command->set_grid_size(10,10);
        $this->command->set_rover_location(11,9,'H');
        $position =  $this->command->get_rover_location();
        $this->assertEquals('0 9 N',$position);
    }
}
