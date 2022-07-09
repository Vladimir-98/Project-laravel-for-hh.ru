<?php

namespace App\Filters;

class ProjectFilter extends QueryFilter
{
    /**
     * ГОРОДА
     * @param $id
     * @return mixed
     */

    public function city_id($id): mixed
    {
        if ($id == 'all') {
            $city = $this->builder;
        } else {
            $city = $this->builder->where('city_id', $id);
        }

        return $city;
    }

    /**
     * РАЙОНЫ
     * @param $id
     * @return mixed
     */

    public function district_id($id): mixed
    {
        if ($id == 'all') {
            $district = $this->builder;
        } else {
            $district = $this->builder->where('district_id', $id);
        }

        return $district;
    }

    /**
     * МОРЕ
     * @param $id
     * @return mixed
     */

    public function sea($id): mixed
    {
        if ($id == '1') {
            $sea = $this->builder->where('sea', '<', 500);
        } else if ($id == '500') {
            $sea = $this->builder->where('sea', '>', 500)->where('sea', '<', 1000);
        } else if ($id == '1000') {
            $sea = $this->builder->where('sea', '>', 1000);
        } else {
            $sea = $this->builder;
        }
        return $sea;
    }

    /**
     * ГАЗ
     * @param $id
     * @return mixed
     */

    public function gas($id): mixed
    {
        if ($id == 'all') {
            $gas = $this->builder;
        } elseif ($id == '1') {
            $gas = $this->builder->where('gas', $id);
        } else {
            $gas = $this->builder->where('gas', '2');
        }

        return $gas;
    }

    /**
     * НАЛИЧИЕ КВАРТИР
     * @param $id
     * @return mixed
     */

    public function availability($id): mixed
    {
        if ($id == 'all') {
            $availability = $this->builder;
        } elseif ($id == '1') {
            $availability = $this->builder->where('availability', '>', '0');
        } else {
            $availability = $this->builder->where('availability', '=', NULL);
        }

        return $availability;
    }

    /**
     * РАССРОЧКА
     * @param $id
     * @return mixed
     */

    public function installments($id): mixed
    {
        if ($id == '1') {
            $installments = $this->builder->where('installments', $id);
        } else {
            $installments = $this->builder;
        }

        return $installments;
    }

    /**
     * БАССЕЙН
     * @param $id
     * @return mixed
     */

    public function pool($id): mixed
    {
        if ($id == '1') {
            $pool = $this->builder->where('pool', $id);
        } else {
            $pool = $this->builder;
        }

        return $pool;
    }

    /**
     * САУНА
     * @param $id
     * @return mixed
     */

    public function sauna($id): mixed
    {
        if ($id == '1') {
            $sauna = $this->builder->where('sauna', $id);
        } else {
            $sauna = $this->builder;
        }

        return $sauna;
    }

    /**
     * ХАММАМ
     * @param $id
     * @return mixed
     */

    public function hammam($id): mixed
    {
        if ($id == '1') {
            $hammam = $this->builder->where('hammam', $id);
        } else {
            $hammam = $this->builder;
        }

        return $hammam;
    }

    /**
     * ФИТНЕС
     * @param $id
     * @return mixed
     */

    public function fitness($id): mixed
    {
        if ($id == '1') {
            $fitness = $this->builder->where('fitness', $id);
        } else {
            $fitness = $this->builder;
        }

        return $fitness;
    }

    /**
     * ЗОНА ОТДЫХА
     * @param $id
     * @return mixed
     */

    public function relaxation($id): mixed
    {
        if ($id == '1') {
            $relaxation = $this->builder->where('relaxation', $id);
        } else {
            $relaxation = $this->builder;
        }

        return $relaxation;
    }

    /**
     * ЗОНА БАРБЕКЮ
     * @param $id
     * @return mixed
     */

    public function barbecue($id): mixed
    {
        if ($id == '1') {
            $barbecue = $this->builder->where('barbecue', $id);
        } else {
            $barbecue = $this->builder;
        }

        return $barbecue;
    }

    /**
     * СПОРТИВНАЯ ПЛОЩАДКА
     * @param $id
     * @return mixed
     */

    public function sport($id): mixed
    {
        if ($id == '1') {
            $sport = $this->builder->where('sport', $id);
        } else {
            $sport = $this->builder;
        }

        return $sport;
    }

    /**
     * КВАДРАТУРА
     * @param $id :string
     * @return mixed
     */

    public function quadrature($id): mixed
    {
        if ($id) {
            $quadrature = $this->builder->where('quadrature', $id);
        } else {
            $quadrature = $this->builder;
        }

        return $quadrature;
    }

    /**
     * СТАТУС ПРОДАЖИ
     * @param $id
     * @return mixed
     */

    public function status($id): mixed
    {
        if ($id == '1') {
            $status = $this->builder->where('status', $id);
        } else {
            $status = $this->builder;
        }
        return $status;
    }

    /**
     * ЭТАЖ
     * @param $id :string
     * @return mixed
     */

    public function floor($id): mixed
    {
        if ($id) {
            $floor = $this->builder->where('floor', $id);
        } else {
            $floor = $this->builder;
        }

        return $floor;
    }

    /**
     * НАЛИЧИЕ КВАРТИР
     * @param $id
     * @return mixed
     */

    public function layout($id): mixed
    {
        if ($id == 'all') {
            $layout = $this->builder;
        } else {
            $layout = $this->builder->where('layout', $id);
        }

        return $layout;
    }

    /**
     * КУХНЯ
     * @param $id
     * @return mixed
     */

    public function kitchen($id): mixed
    {
        if ($id == 'all') {
            $kitchen = $this->builder;
        } else {
            $kitchen = $this->builder->where('kitchen', $id);
        }

        return $kitchen;
    }

    /**
     * БАЛКОН
     * @param $id :string
     * @return mixed
     */

    public function balcony($id): mixed
    {
        if ($id) {
            $balcony = $this->builder->where('balcony', $id);
        } else {
            $balcony = $this->builder;
        }
        return $balcony;
    }

    /**
     * ВАННАЯ
     * @param $id :string
     * @return mixed
     */

    public function bathroom($id): mixed
    {
        if ($id) {
            $bathroom = $this->builder->where('bathroom', $id);
        } else {
            $bathroom = $this->builder;
        }
        return $bathroom;
    }

    /**
     * СПАЛЬНЯ
     * @param $id :string
     * @return mixed
     */

    public function bedroom($id): mixed
    {
        if ($id) {
            $bedroom = $this->builder->where('bedroom', $id);
        } else {
            $bedroom = $this->builder;
        }
        return $bedroom;
    }

    /**
     * МЕБЕЛЬ
     * @param $id
     * @return mixed
     */

    public function furniture($id): mixed
    {
        if ($id == 'all') {
            $furniture = $this->builder;
        } else {
            $furniture = $this->builder->where('furniture', $id);
        }

        return $furniture;
    }

    /**
     * ЦЕНА
     * @param $id
     * @return mixed
     */

    public function price($id): mixed
    {
        return $this->builder->orderBy('price', $id);
    }

    /**
     * ID ДАТА
     * @param $id
     * @return mixed
     */

    public function id($id): mixed
    {
        return $this->builder->orderBy('id', $id);
    }

}
