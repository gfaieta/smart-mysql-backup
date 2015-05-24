# Smart MySQL backup
Performs a backup of a local MySQL instance by dumping each table to a separate file. Uses **GNU make** to check modification times and only dumps tables modified since last backup. For InnoDb tables, requires **innodb_file_per_table** in *my.cnf*

### How to install
Create a directory to hold MySQL backups and copy all files from this repo into it.

### Configuration
  - Edit MySQL credentials in *Makefile.db* and *tablelist.php*
  - Specify MySQL data directory in *Makefile.db*
  - Customize DBs and/or tables to exclude from backup in *tablelist.php*

#### Cons
  - Requires PHP to enumerate tables with ignore lists;
  - DB user configuration must be written in two files.

#### Pros
  - **It works!!** :-D

