CREATE TABLE "public"."scriptures" (
  id SERIAL NOT NULL PRIMARY KEY,
  book varchar(50) NOT NULL,
  chapter int4 NOT NULL,
  verse int4 NOT NULL,
  content text NOT NULL
) WITH (OIDS=FALSE);

CREATE TABLE "public"."topic" (
  id SERIAL NOT NULL PRIMARY KEY,
  name varchar(50) NOT NULL
) WITH (OIDS=FALSE);

CREATE TABLE "public"."topic_scriptures" (
  id SERIAL NOT NULL PRIMARY KEY,
  topic_id int4 NOT NULL REFERENCES public.topic(id),
  scripture_id int4 NOT NULL REFERENCES public.scriptures(id)
) WITH (OIDS=FALSE);

1 - Fe
2 - Caridad


1 - Luis - 1 - 1 - My life
1 - Luis - 1 - 1 - My life

1 - 1 - 1
2 - 2 - 1