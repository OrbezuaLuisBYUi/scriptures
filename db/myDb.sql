CREATE TABLE "public"."scriptures" (
  id SERIAL NOT NULL PRIMARY KEY,
  book varchar(50) NOT NULL,
  chapter int4 NOT NULL,
  verse int4 NOT NULL,
  content text NOT NULL
) WITH (OIDS=FALSE);