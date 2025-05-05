create table if not exists users
(
    id            serial
        constraint users_pk
            primary key,
    first_name    varchar(63)             not null,
    second_name   varchar(63)             not null,
    middle_name   varchar(63)             not null,
    date_of_birth integer                 not null,
    password      varchar(255)            not null,
    email         varchar(63)             not null,
    created_at    timestamp default now() not null
)