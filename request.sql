
CREATE TABLE `comment`(
`id`int(100) not NULL AUTO_INCREMENT PRIMARY KEY,
`comment_name`VARCHAR (100)not NULL,
`text`VARCHAR (100)not NULL,
`parent_id`int(100) not NULL,

`lft`int(100) not NULL,
`rgt`int(100) not NULL
);


INSERT INTO `comment` (`id`,`comment_name`,`text`,`lft`,`rgt`,`parent_id`)
VALUES (1,'root','qqqq',1,2,0);
