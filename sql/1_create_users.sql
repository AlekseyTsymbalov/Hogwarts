create table if not exists public.users
(
    id         serial
        constraint users_pk
            primary key,
    login      varchar(63)             not null
        constraint users_pk_2
            unique,
    password   varchar(255)            not null,
    email      varchar(255)            not null,
    created_at timestamp default now() not null,
    age        integer                 not null
)