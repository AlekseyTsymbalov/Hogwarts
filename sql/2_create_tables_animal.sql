CREATE TABLE animals (
    id SERIAL PRIMARY KEY NOT NULL,
    name varchar(63) not null,
    type varchar(63) not null,
    owner_id integer not null
)