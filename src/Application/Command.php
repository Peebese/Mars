<?php


namespace PhilipBrown\Mars\Application;


class Command
{
    /**
     * @var Navigate
     */
    public $navigate;

    /**
     * Command constructor.
     *
     * @param Navigate $navigate
     */
    public function __construct(Navigate $navigate)
    {
        $this->navigate = $navigate;
    }

    /**
     * @param string $commands
     */
    public function interpret_string_command(string $commands)
    {
        foreach (str_split($commands) as $char) {
            $this->navigate->move($char);
        }
    }

    /**
     * @param int $x
     * @param int $y
     */
    public function set_grid_size(int $x, int $y)
    {
        $this->navigate->grid_x_max = $x;
        $this->navigate->grid_y_max = $y;
    }

    /**
     * @return array
     */
    public function get_grid_size()
    {
        return [
            'grid_x_max' => $this->navigate->grid_x_max,
            'grid_y_max' => $this->navigate->grid_y_max
        ];
    }

    /**
     * @return string
     */
    public function get_rover_location() : string
    {
        return $this->navigate->get_position();
    }

    /**
     * @param int    $x
     * @param int    $y
     * @param string $command
     *
     */
    public function set_rover_location(int $x, int $y, string $command)
    {
        $this->navigate->set_position( $x,  $y,  $command);
    }
}
