<?php

return [

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

    'recaptcha'            => 'El campo :attribute no es válido.',
    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'                => 'El campo :attribute sólo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute sólo puede contener letras, números y guiones (a-z, 0-9, -_).',
    'alpha_num'            => 'El campo :attribute sólo puede contener letras y números.',
    'array'                => 'El campo :attribute debe ser un array.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',

    'between'              => [
        'numeric' => 'El campo :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El campo confirmación de :attribute no coincide.',
    'country'              => 'El campo :attribute no es un país válido.',
    'date'                 => 'El campo :attribute no corresponde con una fecha válida.',
    'date_format'          => 'El campo :attribute no corresponde con el formato de fecha :format.',
    'different'            => 'Los campos :attribute y :other han de ser diferentes.',
    'digits'               => 'El campo :attribute debe ser un número de :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe contener entre :min y :max dígitos.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El campo :attribute no corresponde con una dirección de e-mail válida.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'exists'               => 'El campo :attribute no existe.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute debe ser igual a alguno de estos valores :values',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe ser una cadena de texto JSON válida.',
    'max'                  => [
        'numeric' => 'El campo :attribute debe ser :max como máximo.',
        'file'    => 'El archivo :attribute debe pesar :max kilobytes como máximo.',
        'string'  => 'El campo :attribute debe contener :max caracteres como máximo.',
        'array'   => 'El campo :attribute debe contener :max elementos como máximo.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo de tipo :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe tener al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe contener al menos :min caracteres.',
        'array'   => 'El campo :attribute no debe contener más de :min elementos.',
    ],
    'not_in'               => 'El campo :attribute seleccionado es invalido.',
    'numeric'              => 'El campo :attribute debe ser un numero.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato del campo :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio',
    'required_if'          => 'El campo :attribute es obligatorio cuando el campo :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other se encuentre en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ningún campo :values están presentes.',
    'same'                 => 'Los campos :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'El campo :attribute debe contener :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'state'                => 'El estado no es válido para el país seleccionado.',
    'string'               => 'El campo :attribute debe contener solo caracteres.',
    'timezone'             => 'El campo :attribute debe contener una zona válida.',
    'unique'               => 'El elemento :attribute ya está en uso.',
    'url'                  => 'El formato de :attribute no corresponde con el de una URL válida.',
    'youtube'              => 'La URL ingresada debe corresponder a YouTube.',
    'vimeo'                => 'La URL ingresada debe corresponder a Vimeo.',
    'soundcloud'           => 'La URL ingresada debe corresponder a SoundCloud.',
    'rut'                  => 'El rut ingresado no es válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'name' => 'nombre',
        'images' => 'imágenes',
        'image' => 'imágen',
        'title' => 'título',
        'body' => 'contenido',
        'subtitle' => 'subtítulo',
        'date' => 'fecha',
        'reason' => 'motivo',
        'names' => 'nombres',
        'surnames' => 'apellidos',
        'address' => 'dirección',
        'phone' => 'teléfono',
        'message' => 'mensaje',
        'file' => 'archivo',
        'g-recaptcha-response' => 'validación',
        'origin_id' => 'origen',
        'instruction_id' => 'instrucción',
        'document_type_id' => 'tipo de documento',
        'broadcast_date' => 'fecha de emisión',
        'matter' => 'materia',
        'document_number' => 'número de documento',
        'arrival_date' => 'fecha de llegada',
        'department_id' => 'departamento',
        'user_primary_id' => 'encargado principal',
        'user_secondary_id' => 'encargado secundario',
        'time' => 'tiempo',
        'importance' => 'importancia',
        'content' => 'contenido',
        'files' => 'documentación',
        'users' => 'usuarios',
        'gross_amount' => 'monto anual',
        'contract_start_date' => 'inicio de convenio',
        'contract_end_date' => 'término de convenio',
        'accounts' => 'cuentas',
        'functions' => 'labores específicas',
        'new_user_names' => 'nombres',
        'new_user_surnames' => 'apellidos',
        'new_user_rut' => 'rut',
        'new_user_birth_date' => 'fecha de nacimiento',
        'new_user_gender' => 'género',
        'new_user_email' => 'correo electrónico',
        'new_user_annexed' => 'anexo',
        'new_user_position_id' => 'cargo',
        'new_user_department_id' => 'departamento',
        'new_user_civil_state' => 'estado civil',
        'new_user_profession' => 'profesión u oficio',
        'new_user_education_level' => 'nivel de educación',
        'derivar_users_inform' => 'usuarios con copia informar',
        'derivar_users_resolve' => 'usuarios con copia resolver',
        'rederivar_users_inform' => 'usuarios con copia informar',
        'rederivar_users_resolve' => 'usuarios con copia resolver',
        'civil_state' => 'estado civil',
        'profession' => 'profesión u oficio',
        'education_level' => 'nivel de educación',
        'photocopy_identity_card' => 'fotocopia carnet de identidad',
        'certificate_studies' => 'certificado de estudios',
        'curriculum_vitae' => 'curriculum_vitae',
        'background_certificate' => 'certificado de antecedentes',
        'files.*' => 'documentación',
        'additional_value' => 'observación horas extras',
        'additional_honorary_september_december' => 'adicionales Sept. Dic.',
        'additional_hours' => 'horas extras',
        'personal_cellphone' => 'número telefónico personal',
        'user_birth_date' => 'fecha de nacimiento',
        'user_gender' => 'género',
        'user_email' => 'correo electrónico',
        'user_civil_state' => 'estado civil',
        'user_address' => 'domicilio',
        'user_education_level' => 'nivel educación',
        'user_profession' => 'profesión u oficio',
        'user_personal_cell_phone' => 'número telefónico personal',
        'new_user_personal_cell_phone' => 'teléfono celular',
        'new_user_admission_date' => 'fecha de ingreso',
        'new_user_address' => 'domicilio',
        'new_user_commune_id' => 'comuna',
        'commune_id' => 'comuna',
        'user_commune_id' => 'comuna',
        'client_id' => 'cliente',
        'room_name' => 'nombre del chat',
        'room_description' => 'breve descripción',
        'room_users' => 'participantes',
        'full_name' => 'nombre',
        'activity' => 'actividad',
        'payment_method' => 'metodo de pago',
        'document' => 'archivo',
        'bills' => 'factura',
        'purchases' => 'órden de compra',
        'expiration_date' => 'fecha expiración'
    ],

];
