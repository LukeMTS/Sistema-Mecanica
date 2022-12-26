Neste projeto, foi utilizado Laravel com VueJs, Bootstrap e Docker.

O npm e Vite foram utilizados para o VueJs, então este guia será baseado neles.


1. Realizar uma cópia do .env.example e renomear esta cópia para apenas .env

2. Acessar o terminal e rodar os seguintes comandos no diretório do projeto: 
    - docker-compose up -d --build
    - docker-compose exec laravel-app bash
    - cd /usr/share/nginx
    - composer install
    - chown nginx:nginx -R .
    - php artisan migrate --seed
    - php artisan key:generate

3. Agora é necessário ajeitar uma configuração do nginx:
    - cd /etc/nginx/conf.d/
    - cd /etc/nginx/conf.d/

    Na linha que diz: 
        try_files $uri $uri/ /index.php?$query_string $uri/index.html;
    Alterar para:
        try_files $uri $uri/ /index.php?$query_string;

    - Ctrl + X para sair
    - Y para salvar
    - Enter para manter o nome
    - Reinicie nginx

4. Fora do container
    - npm install
    - npm run dev

3. Acessar a página http://localhost:8080

Alguns logins já foram criados na seed. Um deles é: 
    mecanico1
    senha123