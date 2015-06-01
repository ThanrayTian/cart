这是一个图书网站购物车项目，用PHP实现，具有简单的分类浏览订单付款等功能。

三个阶段：
（一）目录和购物车
（二）管理员登录系统和管理增删商品功能
（三）顾客账号系统

尽量MVC分离。

第一阶段，项目文件结构：

/****Control****/
index.php       ：主页面
show_cat.php    ：某个图书分类页面
show_book.php   ：某本书的详情页面
show_cart.php   ：购物车详情页面
checkout.php    ：结算页面，提供表单填写顾客信息和送货地址，联系方式
purchase.php    ：付款页面，填写信用卡表单，确认付款
process.php     ：购买结果显示页面

/*****Models****/
book_fcns.php   :用于保存和获取图书数据的函数集
order_fcns.php  :用于保存和获取订单数据的函数集
db_fcns.php     :数据库连接和query的一些函数封装

/*****Views*****/
output_fcns.php :各种显示函数



