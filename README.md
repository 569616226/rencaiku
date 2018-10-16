人才库管理说明
php artisan migrate --seed (在有测试服务器数据的情况下运行)

没有测试服务器数据的情况：将database/seeds/DatabaseSeeder.php 文件内注释掉的代码解开

v1.1版本更新说明

表结构修改，

1.增加表： depart_user 表

2.删除字段： 表 users  字段 departs_id

（departs 对 users 关系改为多对多）

3.删除字段： archives 表 offer_depart 字段

4.修改字段： archives 表 internal字段为 int 类型

5.增加字段： settings 表 sync 字段 int

6.修改字段备注： settings 表字段 archives 意思为 薪资设置

7修改.env  文件 CACHE_DRIVER=redis。

8.代码同步后，还要调试对接 岗位、薪资申请单同步。

9.以及 users表 、depart_user表数据同步。

10.promotions 表增加字段 sp_mun、remark  varchar

11.promotions 表删除字段 old_offer、old_depart  

12.promotions 表修改字段 new_depart 字段为varchar类型，可以为空 

13.salaries 表增加字段 sp_mun  varchar

14.salaries 表增修改字段 initial、reality 为basic、added  int






