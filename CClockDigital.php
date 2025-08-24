<?php
/*
** Zabbix
** Copyright (C) 2001-2024 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/


class CClockDigital extends CDiv {


    private $width ; // Устанавливаем ширину по умолчанию
    private $height ; // Устанавливаем высоту по умолчанию
    private $is_enabled = true;

    public function __construct() {
        parent::__construct();
        $this->addClass(ZBX_STYLE_CLOCK);
    }
//$form = CClock::getForm(WIDGET_CLOCK, $data, $templateid);

    public function setWidth($value) {
        $this->width = $value;
        return $this;
    }

    public function setHeight($value) {
        $this->height = $value;
        return $this;
    }

    public function setEnabled($is_enabled) {
        $this->is_enabled = $is_enabled;
        return $this;
    }

    private function build() {
        $time = date('H:i:s'); // Получаем текущее время с секундами.
        $digitalClock = (new CTag('div', true))
            ->setAttribute('class', 'digital-clock')
            ->addItem($time);

        // Устанавливаем размеры часов
        $digitalClock->setAttribute('style', 'width: '.$this->width.'px; height:'.$this->height.'px; font-size: 10em; margin-top: 60px;'); // Увеличиваем шрифт

        if (!$this->is_enabled) {
            $digitalClock->addClass(ZBX_STYLE_DISABLED);
        }

        $this->addItem($digitalClock);
    }

    public function toString($destroy = true) {
        $this->build();
        return parent::toString($destroy);
    }


}
