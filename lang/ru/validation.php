<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted'             => 'Вы должны принять :attribute.',
    'accepted_if'          => 'Вы должны принять :attribute, когда :other соответствует :value.',
    'active_url'           => 'Значение поля :attribute не является действительным URL.',
    'after'                => 'Значение поля :attribute должно быть датой после :date.',
    'after_or_equal'       => 'Значение поля :attribute должно быть датой после или равной :date.',
    'alpha'                => 'Значение поля :attribute может содержать только буквы.',
    'alpha_dash'           => 'Значение поля :attribute может содержать только буквы, цифры, дефис и нижнее подчеркивание.',
    'alpha_num'            => 'Значение поля :attribute может содержать только буквы и цифры.',
    'array'                => 'Значение поля :attribute должно быть массивом.',
    'before'               => 'Значение поля :attribute должно быть датой до :date.',
    'before_or_equal'      => 'Значение поля :attribute должно быть датой до или равной :date.',
    'between'              => [
        'array'   => 'Количество элементов в поле :attribute должно быть между :min и :max.',
        'file'    => 'Размер файла в поле :attribute должен быть между :min и :max Килобайт(а).',
        'numeric' => 'Значение поля :attribute должно быть между :min и :max.',
        'string'  => 'Количество символов в поле :attribute должно быть между :min и :max.',
    ],
    'boolean'              => 'Значение поля :attribute должно быть логического типа.',
    'confirmed'            => 'Значение поля :attribute не совпадает с подтверждаемым.',
    'current_password'     => 'Неверный пароль.',
    'date'                 => 'Значение поля :attribute не является датой.',
    'date_equals'          => 'Значение поля :attribute должно быть датой равной :date.',
    'date_format'          => 'Значение поля :attribute не соответствует формату даты :format.',
    'declined'             => 'Поле :attribute должно быть отклонено.',
    'declined_if'          => 'Поле :attribute должно быть отклонено, когда :other равно :value.',
    'different'            => 'Значения полей :attribute и :other должны различаться.',
    'digits'               => 'Длина значения цифрового поля :attribute должна быть :digits.',
    'digits_between'       => 'Длина значения цифрового поля :attribute должна быть между :min и :max.',
    'dimensions'           => 'Изображение в поле :attribute имеет недопустимые размеры.',
    'distinct'             => 'Значения поля :attribute не должны повторяться.',
    'email'                => 'Значение поля :attribute должно быть действительным электронным адресом.',
    'ends_with'            => 'Поле :attribute должно заканчиваться одним из следующих значений: :values',
    'enum'                 => 'Выбранное значение для :attribute некорректно.',
    'exists'               => 'Выбранное значение для :attribute некорректно.',
    'file'                 => 'В поле :attribute должен быть указан файл.',
    'filled'               => 'Поле :attribute обязательно для заполнения.',
    'gt'                   => [
        'array'   => 'Количество элементов в поле :attribute должно быть больше :value.',
        'file'    => 'Размер файла в поле :attribute должен быть больше :value Килобайт(а).',
        'numeric' => 'Значение поля :attribute должно быть больше :value.',
        'string'  => 'Количество символов в поле :attribute должно быть больше :value.',
    ],
    'gte'                  => [
        'array'   => 'Количество элементов в поле :attribute должно быть :value или больше.',
        'file'    => 'Размер файла в поле :attribute должен быть :value Килобайт(а) или больше.',
        'numeric' => 'Значение поля :attribute должно быть :value или больше.',
        'string'  => 'Количество символов в поле :attribute должно быть :value или больше.',
    ],
    'image'                => 'Файл в поле :attribute должен быть изображением.',
    'in'                   => 'Выбранное значение для :attribute некорректно.',
    'in_array'             => 'Значение поля :attribute не существует в :other.',
    'integer'              => 'Значение поля :attribute должно быть целым числом.',
    'ip'                   => 'Значение поля :attribute должно быть действительным IP-адресом.',
    'ipv4'                 => 'Значение поля :attribute должно быть действительным IPv4-адресом.',
    'ipv6'                 => 'Значение поля :attribute должно быть действительным IPv6-адресом.',
    'json'                 => 'Значение поля :attribute должно быть JSON строкой.',
    'lt'                   => [
        'array'   => 'Количество элементов в поле :attribute должно быть меньше :value.',
        'file'    => 'Размер файла в поле :attribute должен быть меньше :value Килобайт(а).',
        'numeric' => 'Значение поля :attribute должно быть меньше :value.',
        'string'  => 'Количество символов в поле :attribute должно быть меньше :value.',
    ],
    'lte'                  => [
        'array'   => 'Количество элементов в поле :attribute должно быть :value или меньше.',
        'file'    => 'Размер файла в поле :attribute должен быть :value Килобайт(а) или меньше.',
        'numeric' => 'Значение поля :attribute должно быть :value или меньше.',
        'string'  => 'Количество символов в поле :attribute должно быть :value или меньше.',
    ],
    'mac_address'          => 'Значение поля :attribute должно быть корректным MAC-адресом.',
    'max'                  => [
        'array'   => 'Количество элементов в поле :attribute не может превышать :max.',
        'file'    => 'Размер файла в поле :attribute не может быть больше :max Килобайт(а).',
        'numeric' => 'Значение поля :attribute не может быть больше :max.',
        'string'  => 'Количество символов в поле :attribute не может превышать :max.',
    ],
    'mimes'                => 'Файл в поле :attribute должен быть одного из следующих типов: :values.',
    'mimetypes'            => 'Файл в поле :attribute должен быть одного из следующих типов: :values.',
    'min'                  => [
        'array'   => 'Количество элементов в поле :attribute должно быть не меньше :min.',
        'file'    => 'Размер файла в поле :attribute должен быть не меньше :min Килобайт(а).',
        'numeric' => 'Значение поля :attribute должно быть не меньше :min.',
        'string'  => 'Количество символов в поле :attribute должно быть не меньше :min.',
    ],
    'multiple_of'          => 'Значение поля :attribute должно быть кратным :value',
    'not_in'               => 'Выбранное значение для :attribute некорректно.',
    'not_regex'            => 'Значение поля :attribute некорректно.',
    'numeric'              => 'Значение поля :attribute должно быть числом.',
    'password'             => 'Некорректный пароль.',
    'present'              => 'Значение поля :attribute должно присутствовать.',
    'prohibited'           => 'Значение поля :attribute запрещено.',
    'prohibited_if'        => 'Значение поля :attribute запрещено, когда :other равно :value.',
    'prohibited_unless'    => 'Значение поля :attribute запрещено, если :other не состоит в :values.',
    'prohibits'            => 'Значение поля :attribute запрещает присутствие :other.',
    'regex'                => 'Значение поля :attribute некорректно.',
    'required'             => 'Поле :attribute обязательно для заполнения.',
    'required_array_keys'  => 'Массив в поле :attribute обязательно должен иметь ключи: :values',
    'required_if'          => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_unless'      => 'Поле :attribute обязательно для заполнения, когда :other не равно :values.',
    'required_with'        => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_with_all'    => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_without'     => 'Поле :attribute обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле :attribute обязательно для заполнения, когда ни одно из :values не указано.',
    'same'                 => 'Значения полей :attribute и :other должны совпадать.',
    'size'                 => [
        'array'   => 'Количество элементов в поле :attribute должно быть равным :size.',
        'file'    => 'Размер файла в поле :attribute должен быть равен :size Килобайт(а).',
        'numeric' => 'Значение поля :attribute должно быть равным :size.',
        'string'  => 'Количество символов в поле :attribute должно быть равным :size.',
    ],
    'starts_with'          => 'Поле :attribute должно начинаться с одного из следующих значений: :values',
    'string'               => 'Значение поля :attribute должно быть строкой.',
    'timezone'             => 'Значение поля :attribute должно быть действительным часовым поясом.',
    'unique'               => 'Такое значение поля :attribute уже существует.',
    'uploaded'             => 'Загрузка поля :attribute не удалась.',
    'url'                  => 'Значение поля :attribute имеет ошибочный формат URL.',
    'uuid'                 => 'Значение поля :attribute должно быть корректным UUID.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'attributes' => [
        'password' => 'пароль',
        'avatar' => 'аватар',
        'image_1' => '1',
        'image_2' => '2',
        'image_3' => '3',
        'image_4' => '4',
        'image_5' => '5',
        'image_6' => '6',
        'image_7' => '7',
        'image_8' => '8',
        'image_9' => '9',
        'image_10' => '10',
        'image_11' => '11',
        'image_12' => '12',
        'image_13' => '13',
        'image_14' => '14',
        'image_15' => '15',
        'image_16' => '16',
        'image_17' => '17',
        'image_18' => '18',
        'image_19' => '19',
        'image_20' => '20',
        'image_21' => '21',
        'image_22' => '22',
        'image_23' => '23',
        'image_alt_1' => ' Описание 1',
        'image_alt_2' => ' Описание 2',
        'image_alt_3' => ' Описание 3',
        'image_alt_4' => ' Описание 4',
        'image_alt_5' => ' Описание 5',
        'image_alt_6' => ' Описание 6',
        'image_alt_7' => ' Описание 7',
        'image_alt_8' => ' Описание 8',
        'image_alt_9' => ' Описание 9',
        'image_alt_10' => ' Описание 10',
        'image_alt_11' => ' Описание 11',
        'image_alt_12' => ' Описание 12',
        'image_alt_13' => ' Описание 13',
        'image_alt_14' => ' Описание 14',
        'image_alt_15' => ' Описание 15',
        'image_alt_16' => ' Описание 16',
        'image_alt_17' => ' Описание 17',
        'image_alt_18' => ' Описание 18',
        'image_alt_19' => ' Описание 19',
        'image_alt_20' => ' Описание 20',
        'image_alt_21' => ' Описание 21',
        'image_alt_22' => ' Описание 22',
        'image_alt_23' => ' Описание 23',
    ],
];
