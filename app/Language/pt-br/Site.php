<?php
return [
    'sidebar' => [
        'intro' => 'Bem vindo',
        'products' => 'Produtos',
        'posts'  => 'Postagens',
        'whatweare' => 'O que fazemos',
        'contacts' => 'Contatos'
    ],
    'form'=> [
        'add' => 'Adicionar',
        'edit' => 'Editar',
        'delete' => 'Excluir',
        'save' => 'Salvar',
        'reset' => 'Desfazer',
        'wait' => 'aguarde...',
        'inserted' => 'Novo intem foi inserido',
        'updated' => 'Item foi salvo',
        'deleted' => 'Item foi excluído',
        'recovered' => 'Item foi recupedado',
        'selectItem' => 'Selecionar este item',
        'requestEmpty' => 'Nenhum dado foi enviado',
        'validation' => [
            'required' => '{0} é obrigatório',
            'integer' => '{0} precisa conter um número inteiro',
            'min_length' => '{0} precisa ter no mínimo {1} caracteres',
            'tags' => 'As tags estão incorretas',
            'email' => 'E-mail está incorreto',
        ]
    ],
    'basket' => [
        'title' => 'Cesta de produtos',
        'empty' => 'A cesta está vazia',
        'order' => 'Pedido',
        'total' => 'Total',
        'totalSelected' => 'Total selecionado',
        'noSelected' => 'Por favor, selecione ao menos um item antes de enviar o pedido',
         'buttons' => [
            'clear' => 'Esvaziar cesta',
            'quant' => 'Quantidade',
            'increase' => 'Acrescentar uma unidade',
            'decrease' => 'Retirar uma unidade',
            'remove' => 'Remover este item',
            'clear' => 'Esvaziar cesta',
            'sent'  => 'Enviar pedido',
        ]
    ],
    'order' => [
        'title' => 'Pedidos',
        'subtitle' => 'Estes são os seus pedidos',
        'empty' => 'Você ainda não tem nenhum pedido',
        'not' => 'Você não selecionou nenhum item para o pedido',
        'fields' => [
            'key' => 'Chave',
            'idpub' => 'Código',
            'produtos' => 'Produtos',
            'price_total' => 'Valor',
            'status' => 'Situação',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado',
        ],
    ],
    'users' =>[
        'name' => 'Nome',
        'identifier' => 'E-mail ou telefone',
        'password' => 'Senha',
        'repassword' => 'Repetir senha',
        'email' => 'E-mail',
        'phone' => 'Telefone',
        'save' => 'Salvar',
        'saved' => 'Informações foram salvas',
        'logged' => 'Usuário {0} conectado',
        'exists' => 'Já existe um usuário identificado pelo{0} campo{0} {1}',
        'notfound' => 'Usuário {0} não foi encontrado',
        'invalidpassword' => 'Senha inválida para o login {0}',
        'error' => 'Erro na consulta',
        'passnotequal' => 'Senha e repetir senha não são iguais',
        'passforgot' => 'Esqueci minha senha',
        'passforgotsend' => 'Mensagem de recuperação de senha foi enviada para o e-mail {0}',
        'passforgotnotsend' => 'Desculpe, mas não foi possível enviar a mensagem de recuperação de senha para o e-mail {0}',
        'passrecover' => [
            'randonCodeExpired'  => 'A validade deste código de segurança está expirada, por favor, gere um novo codigo.',
            'randonCodeNew'  => 'Solicitar novo código de segurança',
            'title' => 'Recuperação de senha',
            'text' => 'Por favor escolha sua nova senha e confirme',
            'newpass' => 'Digite sua nova senha',
            'renewpass' => 'Redigite sua nova senha',
            'send'      => 'Enviar' ,
        ]
    ],
    'status' => [
        'Open' => 'Aberto',
        'Wait' => 'Aguardando',
        'Paid' => 'Pago',
        'Finished' => 'Finalizado',
        'Deleted' => 'Excluido',
    ],
    'login' => [
        'title' => 'Faça seu login!',
        'subtitle' => 'Indentifique-se para ter acesso completo',
        'not'   => 'Para continuar é necessário identificar-se, por favor informe seus dados',
        'join'  => ['text'=> 'Vem com agente', 'title'=>'Clique para entrar'],
        'logout'  => ['text'=> 'Até mais', 'title'=>'Clique para sair'],
        'order'  => ['text'=> 'Meus pedidor', 'title'=>'Clique para ver meus pedidos'],
        'enter' => 'Entrar',
        'register' => [
            'title' => 'Faça seu cadastro',
            'subtitle' => 'Forneça seus dados de indentificação',
            'invite' => 'Fazer cadastro',
            ''
        ],
        'passforgot' => [
            'title' => 'Ensqueceu a senha?',
            'text' => 'Informe seu e-mail cadastrado conosco que lhe enviaremos uma mensagem com instruções para recuperar seu acesso.',
            'send' => 'Enviar',
        ],

    ],
    'home' => [
        'title' => 'Estou bem aqui!',
        'subtitle' => 'Auto desenvolvimento profundo',
        'maintext' => 'Materiais para auxilio no auto desenvolvimento de forma simples, profunda e eficaz<br />Veja abaixo como fazer.',
        'buttons' => [
            'learnmore' => 'Saiba mais',
            'add' => 'Adicionar',
            'clear' => 'Esvaziar',
            'remover' => 'Remover',
            'buy' => 'Comprar',
        ],

        'products' => [
           'title' => 'Produtos',
           'labels' => [
                'category' => 'Categoria',
                'key' => 'Chave',
                'idpub' => 'ID público',
                'title' => 'Título',
                'subtitle' => 'Subtitulo',
                'cover' => 'Capa',
                'price' => 'Preço',
                'price_promo' => 'Preço promocional',
                'tags' => 'Tags',
                'description' => 'Descrição',
                'author' => "Autor",
                'pages' => "Páginas",
            ],
            'count' => '{0} produtos',
            'error' => [
                'notFound' => 'Nunhum item foi localizado',
                'deleted' => 'Este livro está excluido',
                'deletedRecover' => 'Clique aqui para recuperá-lo',
            ],
        ],
        'posts' => [
            'title' => 'Postagens',
            'labels' => [
                'key' => 'Chave',
                'idpub' => 'ID público',
                'tags' => 'Tags',
                'title' => 'Título',
                'subtitle' => 'Subtitulo',
                'description' => 'Descrição',
                'author' => "Autor",
                'text' => "Texto",
                'public' => "Publicado",
                'public_at' => "Publicado em",
            ],
            'count' => '{0} postagens',
            'error' => [
                'notFound' => 'Nunhuma postagem foi localizada',
                'deleted' => 'Esta postagem está excluida',
                'deletedRecover' => 'Clique aqui para recuperá-la',
            ],
        ],
        'rating' => [
            'title' => 'Avaliações',
            'avg' => 'Média',
            'of' => 'de',
            'singular' => 'avaliação',
            'plural' => 'avaliações',
            'success' => 'Obrigado por sua avaliação',
            'error' => 'Descule, mas não conseguimos salvar a sua avaliação',
        ],
        'comments' => [
            'title' => 'Comentários',
            'singular' => 'conentário',
            'plural' => 'conentários',
            'by' => 'Por',
            'at' => 'em',
            'send' => 'Enviar',
            'success' => 'Obrigado por seu comentário',
            'error' => 'Descule, mas não conseguimos salvar a seu comentário',
            'delete_success' => 'Seu comentário foi apagado',
            'delete_error' => ' Descule, mas não conseguimos apagar a seu comentário {0}',
            'invalid' => 'Comentário inválido',
        ],
        'whatweare' => [
            'title' => 'O que fazemos',
            'text' => 'Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis lorem. ',
            'items' => [
                1 => [
                    'title' => 'Lorem ipsum amet',
                    'text' => 'Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.'
                ],
                2 => [
                    'title' => 'Veroeros quis lorem',
                    'text' => 'Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.'
                ],
                3 => [
                    'title' => 'Urna quis bibendum',
                    'text' => 'Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.'
                ],
                3 => [
                    'title' => 'Aliquam urna dapibus',
                    'text' => 'Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.'
                ],
            ]
        ],
        'contacts' => [
            'title' => 'Contatos',
            'text' => 'Texto dos contatos',
        ],
    ]
];