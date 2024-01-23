<?php 

return [
    'accepted' => ':attribute должен быть заполнен',
    'active_url' => 'В :attribute не является допустимым URL-адресом.',
    'after' => 'В :attribute должна быть дата позднее :date.',
    'after_or_equal' => 'Дата в :attribute равна или поздее чем :date.',
    'alpha' => 'Поле :attribute может содержать только буквы.',
    'alpha_dash' => 'Поле :attribute может содержать только буквы, цифры и тире.',
    'alpha_num' => 'Поле :attribute может содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => 'В :attribute должна быть дата до :date.',
    'before_or_equal' => 'В :attribute должна быть дата до или равна :date.',
    'between' => [
        'numeric' => ':attribute должен находиться между :min и :max.',
        'file' => 'В :attribute должен находиться между :min и :max КБ.',
        'string' => 'Поле :attribute должно находиться между :min и :max символами.',
        'array' => 'В :characters :min и :max товарами.',
    ],
    'boolean' => ':field должно быть да или нет',
    'confirmed' => 'В :подтверждение атрибута не соответствует.',
    'date' => 'В :attribute не является допустимой датой.',
    'date_equals' => 'В :attribute должна быть дата, равная :date.',
    'date_format' => 'В :attribute не соответствует формату :format.',
    'different' => 'В :attribute и :others должны быть разными.',
    'digits' => 'В :attribute должен быть :digits цифр.',
    'digits_between' => 'В :attribute должен находиться между :min и :max цифрами.',
    'dimensions' => 'Поле :attribute имеет недопустимые размеры изображения.',
    'distinct' => 'В :поле атрибута имеет повторяющееся значение.',
    'email' => ':attribute должен быть действительным адресом электронной почты.',
    'exists' => 'Выбранный :attribute недействителен.',
    'file' => 'В :attribute должен быть файлом.',
    'filled' => 'В :поле атрибута должно быть заполнено',
    'image' => ':attribute должен быть изображением.',
    'in' => 'Выбранный :attribute недействителен.',
    'in_array' => 'В :поле атрибута не существует в :Другие.',
    'integer' => 'В :attribute должен быть целым числом.',
    'ip' => 'В :attribute должен быть действительным IP-адресом.',
    'json' => 'В :attribute должен быть действительной строкой JSON.',
    'max' => [
        'numeric' => 'Поле :attribute не может быть больше чем :max.',
        'file' => 'Поле :attribute не может быть больше чем :max КБ',
        'string' => 'В :attribute не может быть больше чем :max символы.',
        'array' => 'В :attribute может не превышать :max.',
    ],
    'mimes' => 'В :attribute должен быть файлом типа: :format.',
    'mimetypes' => 'В :attribute должен быть файлом типа: :значения.',
    'min' => [
        'numeric' => ':attribute должен быть не менее :min.',
        'file' => 'В :attribute должен быть не менее :min КБ.',
        'string' => 'В :attribute должен быть не менее :min символов.',
        'array' => 'В :attribute должен иметь не менее :min предметов.',
    ],
    'not_in' => 'Выбранное :attribute недействителен.',
    'numeric' => ':attribute должен быть числом.',
    'present' => 'Поле :attribute должно быть заполнено',
    'regex' => 'Недопустимый формат заполнения',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_if' => 'Поле :attribute обязательно для заполнения.',
    'required_unless' => 'Поле :attribute требуется заполнить',
    'required_with' => 'В поле :attribute требуется, когда :значения присутствуют.',
    'required_with_all' => 'В поле :attribute требуется, когда :значения присутствуют.',
    'required_without' => 'В поле :attribute требуется :значений нет.',
    'required_without_all' => 'В поле :attribute требуется, если ни один из :значения присутствуют.',
    'same' => 'Поле :attribute и :other должны совпадать.',
    'size' => [
        'numeric' => 'В :attribute должен быть :size.',
        'file' => 'В :attribute должен быть :size КБ',
        'string' => ':attribute должен быть :size символов.',
        'array' => ':attribute должен содержать :элементы размера.',
    ],
    'starts_with' => 'В :attribute must start with one of the following: :values',
    'string' => ':attribute должен быть строкой.',
    'timezone' => ':attribute должен быть действительной зоной.',
    'unique' => ':attribute уже принят.',
    'uploaded' => ':attribute не удалось загрузить.',
    'url' => ':недопустимый формат атрибута.',
    'required_package_id' => 'You have to select a premium listing option to continue.',
    'required_payment_method_id' => 'Вы должны выбрать метод платежа, чтобы продолжить',
    'blacklist_unique' => 'The :attribute field value is already banned for :type.',
    'blacklist_email_rule' => 'Этот адрес электронной почты занесен в черный список.',
    'blacklist_phone_rule' => 'Этот номер телефона занесен в черный список.',
    'blacklist_domain_rule' => 'Ваш адрес электронной почты занесен в черный список.',
    'blacklist_word_rule' => 'Поле :attribute содержит запрещенные слова или фразы.',
    'blacklist_title_rule' => 'Поле :attribute содержит запрещенные слова или фразы.',
    'between_rule' => ':attribute должен находиться между :min и :max символы.',
    'captcha' => ':attribute - капча заполнена неверно',
    'recaptcha' => ':attribute - капча заполнена неверно',
    'phone' => 'Поле :attribute содержит недопустимое число.',
    'phone_number' => 'Ваш номер телефона недействителен.',
    'username_is_valid_rule' => 'Поле :attribute должно содержать только латинские буквы и цифры. Без знаков препинания и пробелов.',
    'username_is_allowed_rule' => 'Такое :attribute невозможно использовать.',
    'custom' => [
        'database_connection' => [
            'required' => 'Не могу подключиться к серверу MySQL',
        ],
        'database_not_empty' => [
            'required' => 'База данных не пуста. Очистите базу данных или укажите <a href="./database">другую база данных</a>.',
        ],
        'promo_code_not_valid' => [
            'required' => 'Промо-код недействителен',
        ],
        'smtp_valid' => [
            'required' => 'Не удается подключиться к SMTP-серверу',
        ],
        'yaml_parse_error' => [
            'required' => 'Невозможно разобрать yaml. Проверьте синтаксис',
        ],
        'file_not_found' => [
            'required' => 'Файл не найден.',
        ],
        'not_zip_archive' => [
            'required' => 'Файл не в формате zip.',
        ],
        'zip_archive_unvalid' => [
            'required' => 'Не удается прочитать пакет.',
        ],
        'custom_criteria_empty' => [
            'required' => 'Пользовательские критерии не могут быть пустыми.',
        ],
        'php_bin_path_invalid' => [
            'required' => 'Недействительный файл PHP. Пожалуйста, проверьте еще раз.',
        ],
        'can_not_empty_database' => [
            'required' => 'Невозможно DROP определенные таблицы, пожалуйста, очистите свою базу данных вручную и повторите попытку.',
        ],
        'can_not_create_database_tables' => [
            'required' => 'Cannot create certain tables. Please make sure you have full privileges on the database and try again.',
        ],
        'can_not_import_database_data' => [
            'required' => 'Cannot import all the app required data. Please try again.',
        ],
        'recaptcha_invalid' => [
            'required' => 'Проверка reCAPTCHA не пройдена.',
        ],
        'payment_method_not_valid' => [
            'required' => 'Что-то пошло не так с настройкой метода оплаты. Пожалуйста, проверьте еще раз.',
        ],
    ],
    'attributes' => [
        'gender' => 'Пол',
        'gender_id' => 'Пол',
        'name' => 'имя',
        'first_name' => 'имя',
        'last_name' => 'фамилия',
        'user_type' => 'тип пользователя',
        'user_type_id' => 'тип пользователя',
        'country' => 'страна',
        'country_code' => 'страна',
        'phone' => 'телефон',
        'address' => 'адрес',
        'mobile' => 'мобильный номер',
        'sex' => 'пол',
        'year' => 'год',
        'month' => 'месяц',
        'day' => 'день',
        'hour' => 'час',
        'minute' => 'минута',
        'second' => 'секунда',
        'username' => 'имя пользователя',
        'email' => 'адрес электронной почты',
        'password' => 'парооль',
        'password_confirmation' => 'повтрорите пароль',
        'g-recaptcha-response' => 'captcha',
        'accept_terms' => 'сроки',
        'category' => 'категория',
        'category_id' => 'категория',
        'post_type' => 'тип объявления',
        'post_type_id' => 'тип объявления',
        'title' => 'заголовок',
        'body' => 'описание',
        'description' => 'описание',
        'excerpt' => 'отрывок',
        'date' => 'дата',
        'time' => 'время',
        'available' => 'доступно',
        'size' => 'размер',
        'price' => 'цена',
        'salary' => 'стоимость',
        'contact_name' => 'имя',
        'location' => 'месторасположение',
        'admin_code' => 'месторасположение',
        'city' => 'город',
        'city_id' => 'город',
        'package' => 'пакет',
        'package_id' => 'пакет',
        'payment_method' => 'Способ оплаты',
        'payment_method_id' => 'Способ оплаты',
        'sender_name' => 'имя',
        'subject' => 'тема',
        'message' => 'сообщение',
        'report_type' => 'тип отчета',
        'report_type_id' => 'тип отчета',
        'file' => 'файл',
        'filename' => 'имя файла',
        'picture' => 'фото',
        'resume' => 'резюме',
        'login' => 'войти',
        'code' => 'код',
        'token' => 'знак',
        'comment' => 'коментарий',
        'rating' => 'рейтинг',
        'captcha' => 'код безопасности',
        'locale' => 'locale',
        'currencies' => 'Валюты',
        'tags' => 'Теги',
        'from_name' => 'name',
        'from_email' => 'email',
        'from_phone' => 'phone',
    ],
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'not_regex' => 'The :attribute format is invalid.',
    'locale_of_language_rule' => 'The :attribute field is not valid.',
    'locale_of_country_rule' => 'The :attribute field is not valid.',
    'currencies_codes_are_valid_rule' => 'The :attribute field is not valid.',
    'blacklist_ip_rule' => 'The :attribute must be a valid IP address.',
    'custom_field_unique_rule' => 'Это :field_1 имеет :field_2 подписано.',
    'custom_field_unique_rule_field' => 'Это :field_1 уже приписано к :field_2.',
    'custom_field_unique_children_rule' => 'Ребенок :field_1 в :field_1 имеет :field_2 уже назначен.',
    'custom_field_unique_children_rule_field' => 'Это :field_1 Уже зазначено одному :field_2 из :field_2.',
    'custom_field_unique_parent_rule' => 'Родитель :field_1 в :field_1 имеет :field_2 уже назначен.',
    'custom_field_unique_parent_rule_field' => 'Это :field_1 уже назначено родительскому :field_2 в :field_2.',
    'mb_alphanumeric_rule' => 'Please enter a valid content in the :attribute field.',
    'date_is_valid_rule' => 'The :attribute field does not contain a valid date.',
    'date_future_is_valid_rule' => 'The date of :attribute field need to be in the future.',
    'date_past_is_valid_rule' => 'The date of :attribute field need to be in the past.',
    'video_link_is_valid_rule' => 'The :attribute field does not contain a valid (Youtube or Vimeo) video link.',
    'sluggable_rule' => 'The :attribute field contains invalid characters only.',
    'uniqueness_of_listing_rule' => 'Объявление уже сохранено. Перейдите в личный кабинет',
    'uniqueness_of_unverified_listing_rule' => 'You\'ve already posted this listing. Please check your email address or SMS to follow the instructions for validation.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'current_password' => 'Пароль неверен.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute must have :value items or more.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'password' => [
        'letters' => ':attribute должен содержать хотя бы одну букву.',
        'mixed' => ':attribute должен содержать как минимум одну прописную и одну строчную букву.',
        'numbers' => ':attribute должен содержать хотя бы одно число.',
        'symbols' => ':attribute должен содержать хотя бы один символ.',
        'uncompromised' => 'Данный :attribute появился в утечке данных. Пожалуйста, выберите другой :attribute.',
    ],
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'uuid' => 'The :attribute must be a valid UUID.',
];
