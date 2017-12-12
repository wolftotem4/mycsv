# MyCsv

This PHP CLI tool helps you to convert the result from MySQL command to CSV format.

## Installation

```
git clone https://github.com/wolftotem4/mycsv.git
cd mycsv
composer install
```

## Basic Usage

Command Line:

```
> php mycsv data.txt > data.csv
```

data.txt

```
+----------+------------+
| username | phone      |
+----------+------------+
| Bob      | 123-456789 |
| Mary     | 456-789123 |
+----------+------------+
```

data.csv:

```
username,phone
Bob,123-456789
Mary,456-789123
```

