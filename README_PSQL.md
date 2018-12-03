# PostgreSQL - Remote Connections

## Setup Remote User

```sh
sudo -i -u postgres psql
CREATE USER <username> WITH PASSWORD '<password>';
psql <database>
GRANT SELECT ON ALL TABLES IN SCHEMA public TO <username>;
```

## Allowed Hosts

```sh
sudo vim /etc/postgresql/<version>/main/pg_hba.conf
```

```sh
host    <database>     <username>             <home-ip>/32         md5
```

```sh
sudo ufw allow from <home-ip> to any port 5432
```

## Listen

```sh
sudo vim /etc/postgresql/<version>/main/postgresql.conf
```

```sh
listen_addresses = '*'
```

## Restart

```sh
sudo systemctl restart postgresql
sudo systemctl status postgresql
```

## Articles

- https://wiki.postgresql.org/wiki/Tuning_Your_PostgreSQL_Server
- https://www.digitalocean.com/community/tutorials/how-to-secure-postgresql-against-automated-attacks
