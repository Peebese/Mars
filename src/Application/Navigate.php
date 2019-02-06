<?php


namespace PhilipBrown\Mars\Application;


class Navigate
{
    /**
     * @var array
     */
    public $cardinal_points = ['N', 'E', 'S', 'W'];

    /**
     * @var string
     */
    public $cardinal = 'N';

    /**
     * Default x axis
     *
     * @var int
     */
    public $x = 0;

    /**
     * Default y axis
     *
     * @var int
     */
    public $y = 0;

    /**
     * Default x axis max grid
     * @var int
     */
    public $grid_x_max = 5;

    /**
     * Default y axis max grid
     *
     * @var int
     */
    public $grid_y_max = 5;

    /**
     * Combine movement of y and x axis
     */
    private function move_forward()
    {
        $this->move_y_axis();
        $this->move_x_axis();
    }

    /**
     * Changes value of axis
     *
     * @param string $command
     */
    public function move(string $command)
    {
        if ($this->is_move_forward($command)) {
            $this->move_forward();
        }

        if ($this->is_rotate($command)) {
            $this->rotate($command);
        }
    }

    /**
     * @param string $command
     *
     * @return bool
     */
    private function is_move_forward(string $command) : bool
    {
        return strtoupper($command) == 'M';
    }

    /**
     * @param string $command
     *
     * @return bool
     */
    private function is_rotate(string $command) : bool
    {
        return in_array(strtoupper($command), ['L','R']);
    }

    /**
     * Changes y axis by single value
     */
    private function move_y_axis()
    {
        if ($this->cardinal == 'N') {
            $this->y = $this->y < $this->grid_y_max ? $this->y += 1 : $this->y;
        }

        if ($this->cardinal == 'S') {
            $this->y = $this->y > 0 ? $this->y -= 1 : $this->y;
        }
    }

    /**
     * Changes x axis by single value
     */
    private function move_x_axis()
    {
        if ($this->cardinal == 'E') {
            $this->x = $this->x < $this->grid_x_max ? $this->x +=1 : $this->x;
        }

        if ($this->cardinal == 'W') {
            $this->x = $this->x > 0 ? $this->x -= 1 : $this->x;
        }
    }

    /**
     * Changes cardinal value
     *
     * @param $command
     */
    private function rotate($command)
    {
        $cardinalKey = array_search($this->cardinal, $this->cardinal_points);

        if ($command == 'R') {

            $this->cardinal =
                isset($this->cardinal_points[($cardinalKey + 1)])
                    ? $this->cardinal_points[($cardinalKey + 1)]
                    : $this->cardinal_points[0];
        }

        if ($command == 'L') {

            $this->cardinal =
                isset($this->cardinal_points[($cardinalKey - 1)])
                    ? $this->cardinal_points[($cardinalKey - 1)]
                    : end($this->cardinal_points);
        }
    }

    /**
     * @return string
     */
    public function get_position() : string
    {
        return $this->x.' '.$this->y.' '.$this->cardinal;
    }

    /**
     * @param int    $x
     * @param int    $y
     * @param string $cardinal
     */
    public function set_position(int $x, int $y, string $cardinal)
    {
        $this->x = ($x <= $this->grid_x_max && $x > 0) ? $x : 0;
        $this->y = ($y <= $this->grid_y_max && $y > 0) ? $y : 0;

        if (in_array(strtoupper($cardinal), $this->cardinal_points)) {
            $this->cardinal = $cardinal;
        }
    }
}
