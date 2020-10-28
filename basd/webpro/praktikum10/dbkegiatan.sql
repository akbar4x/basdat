create table kategori(
id int primary key auto_increment,
nama varchar(30)
);

create table kegiatan(
id int primary key auto_increment,
kode varchar(10) not null,
judul text,
deskripsi text,
narasumber varchar(100),
kategori_id int references kategori(id),
biaya double,
kapasitas int,
tgl_mulai date,
tgl_akhir date,
tempat varchar(100)
);

create table jenis_peserta(
id int primary key auto_increment,
nama varchar(45)
);

create table peserta(
id int primary key auto_increment,
nomor varchar(15),
email varchar(45),
namalengkap varchar(45),
hp varchar(30),
fbaccount varchar(30),
kegiatan_id int references kegiatan(id),
status varchar(10),
jenis_id int references jenis_peserta(id),
tgl_daftar date
);

insert into kategori values
(default,'Seminar'),
(default,'Workshop'),
(default,'Training'),
(default,'Conferences'),
(default,'Kuliah Umum');

insert into jenis_peserta values
(default,'Mahasiswa'),
(default,'Dosen'),
(default,'Pelajar Umum');

insert into kegiatan values
(default,'K1','Seminar Rembulan #1','Install Windows','Abdi',1,1000000,10,20181212,20181213,'Laboratorium A'),
(default,'K2','Workshop Rembulan #1','Install Linux','Budi',2,2000000,10,20181214,20181215,'Laboratorium B'),
(default,'K3','Training Rembulan #1','Install MacOS','Rudi',3,3000000,10,20181216,20181217,'Laboratorium C');

insert into peserta values
(default,'SEM201701-001','alissa@gmail.com','Alissa Khairunnisa','081290351971','alissafb',1,'Aktif',1,20171001),
(default,'SEM201702-002','faiz01@gmail.com','Faiz Fikri','081290351972','faizfb',1,'Non Aktif',1,20171001),
(default,'SEM201703-003','dudi@gmail.com','Dudi Herlino','081290351973','dudifb',1,'Aktif',1,20171002);

id int primary key auto_increment,
nomor varchar(15),
email varchar(45),
namalengkap varchar(45),
hp varchar(30),
fbaccount varchar(30),
kegiatan_id int references kegiatan(id),
status varchar(10),
jenis_id int references jenis_peserta(id),
tgl_daftar date

create view vw_peserta as
select 
a.nama as kategori,
b.kode,
b.judul as kegiatan,
c.nomor as nopeserta,
c.namalengkap as peserta, 
c.hp, 
c.email,
c.fbaccount,
d.nama as jenis,
c.tgl_daftar
from kategori a 
inner join kegiatan b on a.id = b.kategori_id
inner join peserta c on b.id = c.kegiatan_id
inner join jenis_peserta d on d.id = c.jenis_id
ORDER BY c.nomor;

select * from vw_peserta;