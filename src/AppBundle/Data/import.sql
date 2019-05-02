users query:
select userid, email, handle from  qa_users;

Posts: Query
select postid, `type`, `parentid`, categoryid,`catidpath1`, `catidpath2`, `catidpath3` acount, amaxvote, selchildid, userid, upvotes, downvotes, netvotes, views,format, created, updated, title, content,  tags
from qa_posts where `type` = 'Q' or `type` = 'Q_HIDDEN';

Answers Query
select postid, `type`, `parentid`, categoryid,`catidpath1`, `catidpath2`, `catidpath3` acount, amaxvote, selchildid, userid, upvotes, downvotes, netvotes, views,format, created, updated, title, content,  tags
from qa_posts where `type` = 'A' or `type` = 'A_HIDDEN';

Comments Query
select postid, `type`, `parentid`, categoryid,`catidpath1`, `catidpath2`, `catidpath3` acount, amaxvote, selchildid, userid, upvotes, downvotes, netvotes, views,format, created, updated, title, content,  tags
from qa_posts where `type` = 'C' or `type` = 'C_HIDDEN';

Note Query
select postid, `type`, `parentid`, categoryid,`catidpath1`, `catidpath2`, `catidpath3` acount, amaxvote, selchildid, userid, upvotes, downvotes, netvotes, views,format, created, updated, title, content,  tags
from qa_posts where `type` = 'NOTE';

 `postid` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `type` enum('Q','A','C','Q_HIDDEN','A_HIDDEN','C_HIDDEN','Q_QUEUED','A_QUEUED','C_QUEUED','NOTE') NOT NULL,
 `parentid` int(10) unsigned DEFAULT NULL,
 `categoryid` int(10) unsigned DEFAULT NULL,
 `catidpath1` int(10) unsigned DEFAULT NULL,
 `catidpath2` int(10) unsigned DEFAULT NULL,
 `catidpath3` int(10) unsigned DEFAULT NULL,
 `acount` smallint(5) unsigned NOT NULL DEFAULT '0',
 `amaxvote` smallint(5) unsigned NOT NULL DEFAULT '0',
 `selchildid` int(10) unsigned DEFAULT NULL,
 `closedbyid` int(10) unsigned DEFAULT NULL,
 `userid` int(10) unsigned DEFAULT NULL,
 `cookieid` bigint(20) unsigned DEFAULT NULL,
 `createip` varbinary(16) DEFAULT NULL,
 `lastuserid` int(10) unsigned DEFAULT NULL,
 `lastip` varbinary(16) DEFAULT NULL,
 `upvotes` smallint(5) unsigned NOT NULL DEFAULT '0',
 `downvotes` smallint(5) unsigned NOT NULL DEFAULT '0',
 `netvotes` smallint(6) NOT NULL DEFAULT '0',
 `lastviewip` varbinary(16) DEFAULT NULL,
 `views` int(10) unsigned NOT NULL DEFAULT '0',
 `hotness` float DEFAULT NULL,
 `flagcount` tinyint(3) unsigned NOT NULL DEFAULT '0',
 `format` varchar(20) CHARACTER SET ascii NOT NULL DEFAULT '',
 `created` datetime NOT NULL,
 `updated` datetime DEFAULT NULL,
 `updatetype` char(1) CHARACTER SET ascii DEFAULT NULL,
 `title` varchar(800) DEFAULT NULL,
 `content` varchar(12000) DEFAULT NULL,
 `tags` varchar(800) DEFAULT NULL,
 `name` varchar(40) DEFAULT NULL,
 `notify` varchar(80) DEFAULT NULL,