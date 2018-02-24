CREATE SEQUENCE integer_seq_author;
CREATE TABLE author (
  id integer PRIMARY KEY DEFAULT nextval('integer_seq_author'),
  email varchar(63) NOT NULL,
  name varchar(31) NOT NULL UNIQUE,
  pass_hash varchar(127) NOT NULL,
  api_key varchar(127) DEFAULT NULL,
  ts_create integer,
  ts_update integer,
  recover_key varchar(127) DEFAULT NULL
);
ALTER SEQUENCE integer_seq_author OWNED BY author.id;
CREATE SEQUENCE integer_seq_recipe;
CREATE TABLE recipe (
  id integer PRIMARY KEY DEFAULT nextval('integer_seq_recipe'),
  author_id integer NOT NULL,
  ts_create integer,
  title varchar(55) NOT NULL,
  content text,
  picture_uri varchar(255) DEFAULT NULL,
  is_enable boolean DEFAULT false
);
ALTER SEQUENCE integer_seq_recipe OWNED BY recipe.id;
ALTER TABLE recipe
 ADD CONSTRAINT fk_recipe_author FOREIGN KEY (author_id) REFERENCES author (id);
