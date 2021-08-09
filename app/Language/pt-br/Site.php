<?php
return [
    'sidebar' => [
        'intro' => 'Bem vindo',
        'ebooks' => 'Livros digitais',
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
        'inserted' => 'Novo intem foi inserido',
        'updated' => 'Item foi salvo',
        'deleted' => 'Item foi excluído',
        'recovered' => 'Item foi recupedado',
        'selectItem' => 'Selecionar este item',
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
        'identifier' => 'E-mail ou telefone',
        'password' => 'Senha',
        'logged' => 'Usuário {0} conectado',
        'notfound' => 'Usuário {0} não foi encontrado',
        'invalidpassword' => 'Senha inválida para o login {0}',
        'error' => 'Erro na consulta',
    ],
    'login' =>[
        'title' => 'Faça seu login!',
        'subtitle' => 'Indentifique-se para uma melhor experiência',
        'not'   => 'Para continuar é necessário identificar-se, por favor informe seus dados',
    ],

    'status' => [
        'Open' => 'Aberto',
        'Wait' => 'Aguardando',
        'Paid' => 'Pago',
        'Finished' => 'Finalizado',
        'Deleted' => 'Excluido',
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
                'description' => 'Descrição',
                'author' => "Autor",
                'pages' => "Páginas",
                'cover' => "Capa",
            ],
            'count' => '{0} livros encontrados',
            'error' => [
                'notFound' => 'Nunhum item foi localizado',
                'deleted' => 'Este livro está excluido',
                'deletedRecover' => 'Clique aqui para recuperá-lo',
            ],
        ],
        'posts' => [
            'title' => 'Postagens',
            'labels' => [
                'title' => 'Título',
                'subtitle' => 'Subtitulo',
                'description' => 'Descrição',
                'author' => "Autor",
                'text' => "Texto",
                'public' => "Publicado",
                'public_at' => "Publicado em",
            ],
            'count' => '{0} livros encontrados',
            'error' => [
                'notFound' => 'Nunhuma postagem foi localizada',
                'deleted' => 'Esta postagem está excluida',
                'deletedRecover' => 'Clique aqui para recuperá-la',
            ],
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