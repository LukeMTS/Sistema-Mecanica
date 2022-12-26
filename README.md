Foi utilizado docker neste projeto, para criar o container, basta usar: 
- docker-compose up -d

Depois rodar as migrations com as seeds:
- docker-compose exec laravel-app bash
- cd /usr/share/nginx
- php artisan migrate --seed

Também foi utilizado VueJs, então é necessário o gerenciador de pacotes npm e rodar:
- npm install
- npm run dev