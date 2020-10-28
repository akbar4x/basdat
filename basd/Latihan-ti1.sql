create function salam()
returns text as
$$
	declare
		say text;
	begin
		say := 'Assalamualaikum Teman';
	return say;
	end
$$ language plpgsql

select salam();

create or replace function hello(text)
returns text as
$$
	declare
		nama alias for $1;
		pesan text;
	begin
		pesan := 'Hello ' || nama;
		return pesan;
	end
$$ language plpgsql

select hello('akbar');

create or replace function
luassegitiga(real,real) returns real
as
$$
	declare 
		alas alias for $1;
		tinggi alias for $2;
	begin
		return alas * tinggi * 0.5;
	end
$$ language plpgsql;
select luassegitiga(4,7);


create or replace function
jumlah(real,real) returns real
as
$$
	declare 
		bil alias for $1;
		bal alias for $2;
	begin
		return bil + bal;
	end
$$ language plpgsql;
select jumlah(2,1);

create or replace function
ligkaran(int) returns real
as
$$
	declare 
		bils alias for $1;
	begin
		return bils * bils * 3.14;
	end
$$ language plpgsql;

select ligkaran(7);

create or replace function
kelulusan (varchar, varchar)
returns text as
$$
	declare
		nilai double precision;
		nim_mhs alias for $1;
		kode_mk alias for $2;
	begin
		select into nilai total_nilai from
		nilai_ujian where nim=nim_mhs and kodemk=kode_mk;
	
	if nilai > 65
	then return 'nilai'|| nilai||
	', Lulus';
	else
	return 'nilai'||nilai||
	',Tidak Lulus';
	end if;
	end
$$
language plpgsql

select kelulusan('012011','NF001');

create or replace function 
grade(varchar,varchar)
returns text as
$$
declare
nilai double precision;
	nim_mhs alias for $1;
	kode_mk alias for $2;
	grade_mhs varchar;
	status_lulus text;
	begin
		select into nilai total_nilai from
		nilai_ujian where nim=nim_mhs and kodemk=kode_mk;
	if nilai >= 85.01 and nilai <=100 then grade_mhs :='A'; status_lulus :='Lulus';
	elsif nilai >= 80.01 and nilai <=85 then grade_mhs :='A-'; status_lulus :='Lulus';
	elsif nilai >= 75.01 and nilai <=80 then grade_mhs :='B+'; status_lulus :='Lulus';
	elsif nilai >= 70.01 and nilai <=75 then grade_mhs :='B'; status_lulus :='Lulus';
	elsif nilai >= 65.01 and nilai <=70 then grade_mhs :='B-'; status_lulus :='Lulus';
	elsif nilai >= 60.01 and nilai <=65 then grade_mhs :='c'; status_lulus :='Tidak Lulus';
	elsif nilai >= 55.01 and nilai <=60 then grade_mhs :='c-'; status_lulus :='Tidak Lulus';
	else grade_mhs :='-'; status_lulus :='Tidak ada';
end if;

update nilai_ujian set grade=grade_mhs, status=status_lulus where nim=nim_mhs and kodemk=kode_mk;

return 'nilai: ' || nilai ||', Status: ' || status_lulus || 'Grade: ' || grade_mhs;
end
$$ 
language plpgsql;

select grade ('012011','NF001');

-- trigger
create or replace function
tambah_mhs_log() returns trigger as
$$
begin
	insert into log_table
	(nama_table,aksi,isi) values
	('mahasiswa','INSERT',
	new.id||' - '||new.nama);
	return new;
end
$$ language plpgsql;

create trigger trig_log_input_mhs after
insert on mahasiswa for each row
execute procedure tambah_mhs_log();

select * from mahasiswa;
select * from log_table;

insert into mahasiswa (id,nama)
values(default,'ihsanul fikri');

create or replace function
update_mhs_log() returns trigger as
$$
begin
	insert into log_table
	(nama_table,aksi,isi) values
	('mahasiswa','UPDATE',
	old.id||' - '||old.nama);
	return old;
end
$$ language plpgsql;

create trigger trig_log_update_mhs after
update on mahasiswa for each row
execute procedure update_mhs_log();

update mahasiswa set nama='Muhammad Adil Nashrul Haq' where id=1;
select * from mahasiswa;
select * from log_table;

--latihan
create or replace function update_mhs_grade()
returns trigger as
$$
declare
grade_mhs varchar;
status_lulus text;
nilai double precision;
begin
	nilai := new.total_nilai;
	
	if nilai >= 85.01 and nilai <=100 then grade_mhs :='A'; status_lulus :='Lulus';
	elsif nilai >= 80.01 and nilai <=85 then grade_mhs :='A-'; status_lulus :='Lulus';
	elsif nilai >= 75.01 and nilai <=80 then grade_mhs :='B+'; status_lulus :='Lulus';
	elsif nilai >= 70.01 and nilai <=75 then grade_mhs :='B'; status_lulus :='Lulus';
	elsif nilai >= 65.01 and nilai <=70 then grade_mhs :='B-'; status_lulus :='Lulus';
	elsif nilai >= 60.01 and nilai <=65 then grade_mhs :='c'; status_lulus :='Tidak Lulus';
	elsif nilai >= 55.01 and nilai <=60 then grade_mhs :='c-'; status_lulus :='Tidak Lulus';
	else grade_mhs :='-'; status_lulus :='Tidak ada';
end if;

update nilai_ujian set grade=grade_mhs, status=status_lulus 
where nim=new.nim and kodemk=new.kodemk;

return new;
end
$$
language plpgsql;

create trigger trig_update_mhs_grade after
insert on nilai_ujian for each row execute
procedure update_mhs_grade();

select * from nilai_ujian;
--test trigger
insert into nilai_ujian (id,kodemk,nim,total_nilai) values (default,'NF002','013013',75);

--latihan dbmart--
--1. buat fungsi update_stock_product--
create or replace function update_stock_product(int,int) 
returns text as
$$
declare
product_id alias for $1;
jml_stock alias for $2;
stok_product int;
total_stok int;
pesan text;
begin
	select into stok_product stock from
	products where id=product_id;
	
	if stok_product < 20
		then
		total_stok := stok_product + jml_stock;
		update products set stock=total_stok where id=product_id;
		pesan := 'product dengan ID '||
		product_id||'berhasil diupdate stoknya';
	else
		pesan := 'produk dengan ID'||product_id||'stoknya masih cukup';
	end if;
	return pesan;
end
$$ language plpgsql;

select * from products;

select update_stock_product(1,60);

--no 2--
create or replace function kurangi_stok()
returns trigger as
$$
declare
qty_order int;
total_stok int;
stok_saat_ini int;
begin
	select into stok_saat_ini stock from
	products where id=new.products_id;
	
	qty_order := new.quantity_order;
	if stok_saat_ini < qty_order
		then
		total_stok := stok_saat_ini + qty_order;
		update products set stock=total_stok where
		id=new.products_id;
	else
		total_stok := stok_saat_ini;
	end if;
	--kurangi stock--
	total_stok := total_stok -qty_order;
	update products set stock = total_stok
	where id=new.products_id;
	return new;
end
$$ language plpgsql

create trigger trig_kurangi_stock before insert
on order_details for each row execute
procedure kurangi_stok();

--test trigger--
select * from products;
insert into orders values(default,'2018-10-25',1);
select * from orders;

insert into order_details
(order_id, products_id,quantity_order) values
(1,2,30);
select * from order_details;



insert into order_details
(order_id, products_id,quantity_order) values
(1,1,100);


create or replace function
gnjl(int) returns text
as
$$
	declare 
		bil alias for $1;
	begin
		if bil % 2=0 then return 'genap';
	else return 'ganjil';
	end if;
	end
$$ language plpgsql;

select gnjl(2);

create table jenis_produk(
id int primary key,
nama varchar(45)
);

begin;
insert into jenis_produk values (10,'Assesoris');
insert into jenis_produk values (11,'Komputer');
select *from jenis_produk;
rollback;

begin;
insert into jenis_produk values (12,'Makanan');
insert into jenis_produk values (13,'Minuman');
select *from jenis_produk;
commit;

begin;
delete from jenis_produk where id=12;
savepoint sp1;
delete from jenis_produk where id=13;
select *from jenis_produk;
rollback to savepoint sp1;
commit;

select *from jenis_produk

create table produk(id int primary key, nama varchar(50), stok int);

begin;
insert into produk values(1,'Baju',20);
insert into produk values(2,'Celana',25);
insert into produk values(3,'Sepatu',30);
savepoint sp1;
delete from produk where id=2;
select * from produk;
rollback to savepoint sp1;
commit;

select * from products;
select * from orders;
select * from order_details;
select * from customers;

begin;
	insert into products values(4,'qtela','keripik singkong',70,10000);
	insert into products values(5,'indomilk','susu',50,6500);
	insert into products values(6,'liyong','kopi',55,3000);
	insert into products values(7,'sariwangi','teh',62,2000);
	insert into products values(8,'relaxa','permen',99,500);
savepoint sp1;
select *from products;
insert into orders values(3,current_date,2);
	insert into order_details values(3,4,1,null);
	insert into order_details values(3,5,2,null);
	select *from orders;
	select *from order_details;
rollback to savepoint sp1;
commit;
select * from products;

