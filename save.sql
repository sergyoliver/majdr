create table users_admin
(
  id bigint not null auto_increment
  primary key,
  nom varchar(191) not null,
  email varchar(191) not null,
  password text not null,
  fonction_admin varchar(200) null,
  created_at timestamp null,
  updated_at timestamp null,
  active int default '0' null,
  id_supp int null,
  id_creation int null,
  id_modification int null,
  date_modification varchar(191) null,
  date_suppression varchar(191) null,
  idgroupe int not null,
  prenoms varchar(100) null,
  contact varchar(30) null
)
;

create table gpe_user
(
  idgpe int not null auto_increment
  primary key,
  libgpe varchar(30) null
)
;