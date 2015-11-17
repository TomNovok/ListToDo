<?php
    $config = array
    (
        'login' => array
        (
            array
            (
                'field' => 'username',
                'label' => 'Логин',
                'rules' => 'required'
            ),
            array
            (
                'field' => 'password',
                'label' => 'Пароль',
                'rules' => 'required'
            )
        ),
        'registration' => array
        (
            array
            (
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]|min_length[1]|max_length[30]'
            ),
            array
            (
                'field' => 'full_name',
                'label' => 'Полное имя',
                'rules' => 'required|min_length[1]|max_length[30]|name'
            ),
            array
            (
                'field' => 'password',
                'label' => 'Пароль',
                'rules' => 'required|min_length[1]|max_length[30]|alpha_dash'
            ),
            array
            (
                'field' => 'passconf',
                'label' => 'Подтверждение пароля',
                'rules' => 'required|matches[password]'
            ),
            array
            (
                'field' => 'username',
                'label' => 'Логин',
                'rules' => 'required|is_unique[users.login]|min_length[1]|max_length[30]|alpha_dash'
            )
        ),
        'cabinet1' => array
        (
            array
            (
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|min_length[1]|max_length[30]'
            ),
            array
            (
                'field' => 'full_name',
                'label' => 'Полное имя',
                'rules' => 'required|min_length[1]|max_length[30]|name'
            ),
            array
            (
                'field' => 'username',
                'label' => 'Логин',
                'rules' => 'required|min_length[1]|max_length[30]|alpha_dash'
            )
        ),
        'cabinet2' => array
        (
            array
            (
                'field' => 'password',
                'label' => 'Новый пароль',
                'rules' => 'required|min_length[1]|max_length[30]|alpha_dash'
            ),
            array
            (
                'field' => 'cpassword',
                'label' => 'Старый пароль',
                'rules' => 'required'
            ),
            array
            (
                'field' => 'passconf',
                'label' => 'Подтверждение пароля',
                'rules' => 'required|matches[password]'
            )
        ),
        'help' => array
        (
            array
            (
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|min_length[1]|max_length[30]'
            ),
            array
            (
                'field' => 'full_name',
                'label' => 'Полное имя',
                'rules' => 'required|min_length[1]|max_length[30]|name'
            ),
            array
            (
                'field' => 'subject',
                'label' => 'Тема сообщения',
                'rules' => 'required|min_length[1]|max_length[100]'
            ),
            array
            (
                'field' => 'message',
                'label' => 'Текст сообщения',
                'rules' => 'required|min_length[1]|max_length[2000]'
            )
        )
  );
?>