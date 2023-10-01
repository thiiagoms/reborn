<div align="center">
    <a href="https://github.com/thiiagoms/reborn">
        <img src=".assets/img/fenix.png" alt="Logo" width="150" height="200">
    </a>
    <h3 align="center">
        Site monitoring dashboard
    </h3>
    <p float="left">
        <img
            src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"
            alt="PHP"
        >
        <img
            src="https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white"
            alt="Docker"
        >
    </p>
</div>

- [Dependencies :package:](#dependencies)
- [Install :package:](#install)
- [Use :runner:](#use)

## Dependencies

- Docker :whale:


## Install

01 -) Clone:
```bash
$ git clone https://github.com/thiiagoms/reborn
```

02 -) Go to `reborn` directory:
```bash
$ cd reborn
reborn $
```

03 -) Copy `.env.example` to `.env`:
```bash
reborn $ cp .env.example .env
```

04 -) Setup containers with `docker-compose`:
```bash
reborn $ docker-compose up -d
```

05 -) Install `reborn` dependencies:
```bash
reborn $ docker-compose exec app composer install
reborn $ docker-compose exec app php artisan key:generate
reborn $ docker-compose exec app php artisan migrate
reborn $ docker-compose exec app npm ci
reborn $ docker-compose exec app npm run build
```

06 -) Go to `http://localhost:8000`

FY: ALL notifications are sending to mailhog (`http://localhost:8025`)