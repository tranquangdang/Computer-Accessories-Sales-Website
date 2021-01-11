DROP DATABASE IF EXISTS dangtruong;
CREATE DATABASE dangtruong;
USE dangtruong;

create table tblCustomer
(
	CustID int primary key AUTO_INCREMENT,
	CustName varchar(255) not null,
	CustAddress varchar(255) not null,
	TelNo char(10) not null,
	Email varchar(255) not null,
	Pass varchar(32) not null
) ENGINE = InnoDB;

create table tblProductCategory
(
	CategoryID char(5) primary key,
	CategoryName varchar(255) not null
) ENGINE = InnoDB;

insert into tblProductCategory values ('CPU01', 'CPU AMD');
insert into tblProductCategory values ('CPU02', 'CPU Intel');
insert into tblProductCategory values ('VGA01', 'Card màn hình Nvidia');
insert into tblProductCategory values ('VGA02', 'Card màn hình AMD');
insert into tblProductCategory values ('MAIN1', 'Mainboard Intel');
insert into tblProductCategory values ('MAIN2', 'Mainboard AMD');
insert into tblProductCategory values ('PSU01', 'Nguồn máy tính');
insert into tblProductCategory values ('COOL1', 'Tản nhiệt máy tính');
insert into tblProductCategory values ('CASE1', 'Vỏ máy tính');
insert into tblProductCategory values ('RAM01', 'Bộ nhớ RAM');
insert into tblProductCategory values ('HDD01', 'Ổ cứng HDD');
insert into tblProductCategory values ('SSD01', 'Ổ cứng SSD');
insert into tblProductCategory values ('LAP01', 'Laptop Gaming');
insert into tblProductCategory values ('LAP02', 'Laptop Văn phòng');
insert into tblProductCategory values ('PC001', 'PC Văn phòng');
insert into tblProductCategory values ('PC002', 'PC Gaming');
insert into tblProductCategory values ('LAPIN', 'Pin - cáp sạc laptop');
insert into tblProductCategory values ('ACLAP', 'Linh kiện laptop');
insert into tblProductCategory values ('AVKEY', 'Phần mềm bảo mật');
insert into tblProductCategory values ('WDKEY', 'Windows');
insert into tblProductCategory values ('OSKEY', 'Phầm mềm khác');

create table tblProduct
(
	ProductID int primary key AUTO_INCREMENT,
  	CategoryNo char(5) not null,
  	Brand varchar(255) not null,
	ProductName text not null,
  	ProductImg varchar(255) not null,
  	Intro Mediumtext not null,
	UnitPrice int default 0,
	PerDiscount int default 0,
	QtyOnHand int default 0,
  FOREIGN KEY (CategoryNo) REFERENCES tblProductCategory(CategoryID)
) ENGINE = InnoDB;

insert into tblProduct (CategoryNo, Brand, ProductName, ProductImg, Intro, UnitPrice, QtyOnHand)-- CPU trong đó AMD là CPU01 Intel CPU02
	values	('CPU01', 'AMD', 'CPU AMD Ryzen Threadripper 2970WX (24C/48T, 3.0 GHz - 4.2 GHz, 64MB) - TR4', 'https://lh3.googleusercontent.com/DF4ahxChMtGsJA-EpTo4NE1Zte8xqNM6saYj-xk1mFygnGCVj_wC7v7g4QRVas_o-JOGKGZWOqrxdR3kCxI=w500-rw', 'Được thiết kế để phục vụ nghệ sĩ, biên tập viên, và các kỹ sư, bộ vi xử lý AMD Ryzen Threadripper 2970WX Processor (24-Core, 48-Thread, 4.2 GHz Max Boost) giải phóng sức mạnh \"hoang dã\" nguyên bản từ 24 nhân và 48 luồng xử lý đồng thời. Tối ưu hoá hiệu năng với phần cứng thông minh, AMD SensiMI2 ghi nhớ và điều chỉnh hiệu suất hoạt động cho các chương trình mà bạn sử dụng. Là công cụ đắc lực hỗ trợ Render, thiết kế, chỉnh sửa, sắp xếp, và tạo hình phục vụ các dự án lớn của bạn bằng sức mạnh vô song. Thực hiện đa tác vụ không giới hạn với bộ vi xử lý 24 nhân đầu tiên trên thế giới.', 26300000, 50),
('CPU01', 'AMD', 'CPU AMD Ryzen 5 3500X (6C/6T, 3.6 GHz up to 4.1 GHz, 32MB) - AM4', 'https://lh3.googleusercontent.com/-UBpJAIylk0T_R5MBxuAoZXp73K_-1mHcFojePjcd6H4hj_4KZbQepGGQgpGS1rATCTWS0htx1-_u7Hu7EM=w500-rw', 'AMD Ryzen 5 3500X là vi xử lý CPU mới tương thích với chipset AMD X570, nền tảng Socket AM4 tiên tiến nhất thế giới dành cho những game thủ và những người đam mê ép xung, cung cấp khả năng kiểm soát toàn diện, mức độ thấp, bao gồm công nghệ tăng tốc lưu trữ AMD StoreMI và hỗ trợ cấu hình card đồ họa kép nhờ hai khe card đồ họa PCIe® 4.0.', 3790000, 50),
('CPU02', 'Intel', 'CPU Intel Core I7-7700 (3.6GHz)', 'https://lh3.googleusercontent.com/1BNbXuddiNBvI-F7fu4bA7Qf-_I04X3W1Et7wOr7WLEzstgmPtLOdP_WE3jGBhLP4pZwCL_jXmDbNqDDAw=w1000-rw', 'Bộ Sưu Tập Sản Phẩm 7th Generation Intel® Core™ i7 Processors\r\nTên mã Kaby Lake trước đây của các sản phẩm\r\nPhân đoạn thẳng Desktop\r\nSố hiệu Bộ xử lý i7-7700\r\nTình trạng Launched\r\nNgày phát hành Q1 2017\r\nThuật in thạch bản 14 nm\r\nGiá đề xuất cho khách hàng', 9100000, 50),
('CPU01', 'AMD', 'CPU AMD Ryzen 5 3500 (6C/6T, 3.6 GHz up to 4.1 GHz, 16MB) - AM4', 'https://lh3.googleusercontent.com/LZ25GgiDK-2iUPR61RYozt2blBHxwmJt8OevqyVGnnAxr_PcU_WuUdGxJE9aP_CZOSKwSD7v0-mKCZX0Ze4B=w500-rw', 'AMD Ryzen 5 3500 là vi xử lý CPU mới tương thích với chipset AMD X570, nền tảng Socket AM4 tiên tiến nhất thế giới dành cho những game thủ và những người đam mê ép xung, cung cấp khả năng kiểm soát toàn diện, mức độ thấp, bao gồm công nghệ tăng tốc lưu trữ AMD StoreMI và hỗ trợ cấu hình card đồ họa kép nhờ hai khe card đồ họa PCIe® 4.0.', 3090000, 50),
('CPU01', 'AMD', 'CPU AMD Ryzen 5 2400G (4C/8T, 3.6 GHz - 3.9 GHz, 4MB) - AM4', 'https://lh3.googleusercontent.com/0ahPTmyQ7HuS83JUxU5BIjaSUXLpzuH6mkBUeUPbV_-3TJKxMyWL2HwSc6411FLxAtWor27POumf756pJGk=w500-rw', 'AMD Ryzen 5 3500 là vi xử lý CPU mới tương thích với chipset AMD X570, nền tảng Socket AM4 tiên tiến nhất thế giới dành cho những game thủ và những người đam mê ép xung, cung cấp khả năng kiểm soát toàn diện, mức độ thấp, bao gồm công nghệ tăng tốc lưu trữ AMD StoreMI và hỗ trợ cấu hình card đồ họa kép nhờ hai khe card đồ họa PCIe® 4.0.', 4390000, 50),
('CPU01', 'AMD', 'CPU AMD Ryzen 7 2700 (8C/16T, 3.2 GHz - 4.1 GHz, 16MB) - AM4', 'https://lh3.googleusercontent.com/3y5k6KqCbcmMOkTDSP6ImaZp41ip5XTJEHMf6HlxvXOcBGjHtA2ArhLTvwcBXDUazxOF31R3IwwYYRry-i0=w500-rw', 'CPU AMD Ryzen 7 2700 là dòng CPU có hiệu năng cao với 8 nhân (16 luồng), xung nhịp cơ bản 3.20 GHz, xung tối đa 4.10 GHz, bộ nhớ đệm Cache 20 MB, đem hiệu năng đa nhiệm cao hơn nhiều so với các CPU ở thế hệ trước. Dòng CPU này có khả năng OC cao cấp tăng cường thêm hiệu suất cho hệ thống.', 5990000, 50),
('CPU01', 'AMD', 'CPU AMD Ryzen 5 2400G (4C/8T, 3.6 GHz - 3.9 GHz, 4MB) - AM4', 'https://lh3.googleusercontent.com/0ahPTmyQ7HuS83JUxU5BIjaSUXLpzuH6mkBUeUPbV_-3TJKxMyWL2HwSc6411FLxAtWor27POumf756pJGk=w500-rw', 'AMD Ryzen 5 3500 là vi xử lý CPU mới tương thích với chipset AMD X570, nền tảng Socket AM4 tiên tiến nhất thế giới dành cho những game thủ và những người đam mê ép xung, cung cấp khả năng kiểm soát toàn diện, mức độ thấp, bao gồm công nghệ tăng tốc lưu trữ AMD StoreMI và hỗ trợ cấu hình card đồ họa kép nhờ hai khe card đồ họa PCIe® 4.0.', 4390000, 50),
('CPU02', 'Intel', 'CPU Intel Core i5-9400F (6C/6T, 2.9 - 4.1 GHz, 9MB)', 'https://lh3.googleusercontent.com/WkEFbZM02MrWi2xg_oYUV9wcU24tQoRwRaT4nZmB6Jen1HLD23PZhqkAed_eturDck_kstljO3B7l9H3fjaY=w500-rw', 'CPU intel Core i5-9400F đã lên kệ tại Phong Vũ với 6 nhân thuộc dòng Coffee Lake Refresh và được sản xuất trên tiến trình xử lý 14nm của hãng. CPU Intel Core i5-9400F với hậu tố F khá mới mẻ đến từ việc lược giản GPU onboard với I5-9400. CPU Intel Core i5-9400F hướng đến phục vụ các PC hiệu năng trung bình có nhu cầu khai thác khoảng 6 nhân vật lý và sở hữu card màn hình rời. ', 3900000, 50),
('CPU02', 'Intel', 'CPU Intel Core i5-9400 (6C/6T, 2.90 GHz - 4.10 GHz, 9MB)', 'https://lh3.googleusercontent.com/8boHtORAP4fKowO3NvbXdkHrZhYvSSa6HJhXN5H022pQmLks-aNXKJ3w_FR3CI8Q329f2_tqMpIZHnfYZoo=w500-rw', 'CPU intel Core i5-9400 đã lên kệ tại Phong Vũ với 6 nhân thuộc dòng Coffee Lake Refresh và được sản xuất trên tiến trình xử lý 14nm của hãng. CPU Intel Core i5-9400 ra đời sau i5 9400F, bỏ đi hậu tố F đồng nghĩa với việc CPU này được kích hoạt GPU Intel UHD Graphics 630 vốn từng bị vô hiệu ở bản 9400F. ', 4790000, 50),
('CPU02', 'Intel', 'CPU INTEL Core i7-9700 (8C/8T, 3.00 GHz up to 4.70 GHz, 12MB)', 'https://lh3.googleusercontent.com/XOyZxluqm-sfyMkT2BGM2eDnUMMmcjPC6xmWynaIIUcPM0w1Y1kFckyedveJ7E37Bia-8Bu4wN6XCeTCmZQ=w500-rw', 'Bộ xử lý Intel Core i7-9700 thế hệ thứ 9 đưa hiệu năng máy tính để bàn chính lên một cấp độ hoàn toàn mới. i7-9700 với bộ nhớ cache 12MB và công nghệ Intel® Turbo Boost 2.0 điều chỉnh tần số turbo tối đa lên tới 4.70 GHz. Hỗ trợ đa nhiệm với 8 luồng hiệu suất cao được cung cấp bởi 8 lõi với công nghệ siêu phân luồng Intel® (Công nghệ Intel® HT) để giải quyết khối lượng công việc đòi hỏi khắt khe nhất. ', 8990000, 50),
('CPU02', 'Intel', 'CPU INTEL Core i7-10700K (8C/16T, 3.80GHz Up to 5.10GHz, 16MB)', 'https://lh3.googleusercontent.com/gcXtjI_Kr1mJLabyrjRpwoSom5a7wzm-I0wwuRIOrUCDO9-_JY1GOkGkGPzP8f5OhtB5iaUgDkl-EgFdY_A=w500-rw', 'Bộ xử lý Intel Core i7-10700 thế hệ thứ 10 đưa hiệu năng máy tính để bàn chính lên một cấp độ hoàn toàn mới. i7-9700 với bộ nhớ cache 12MB và công nghệ Intel® Turbo Boost 2.0 điều chỉnh tần số turbo tối đa lên tới 4.70 GHz. Hỗ trợ đa nhiệm với 8 luồng hiệu suất cao được cung cấp bởi 8 lõi với công nghệ siêu phân luồng Intel® (Công nghệ Intel® HT) để giải quyết khối lượng công việc đòi hỏi khắt khe nhất. ', 10990000, 50),
('CPU02', 'Intel', 'CPU INTEL Core i9-10900K (10C/20T, 3.70 GHz Up to 5.30 GHz, 20MB)', 'https://lh3.googleusercontent.com/sLfT5QZ45SC-p4wCyUHdCnbZgEHrWsIhopPuw6QC3qHW4wD9FLIgjbkZkKHefPo0IK7PguV6VdXC6v483bY=w500-rw', 'Bộ xử lý Intel Core i9-10900 thế hệ thứ 10 đưa hiệu năng máy tính để bàn chính lên một cấp độ hoàn toàn mới. i7-9700 với bộ nhớ cache 12MB và công nghệ Intel® Turbo Boost 2.0 điều chỉnh tần số turbo tối đa lên tới 4.70 GHz. Hỗ trợ đa nhiệm với 8 luồng hiệu suất cao được cung cấp bởi 8 lõi với công nghệ siêu phân luồng Intel® (Công nghệ Intel® HT) để giải quyết khối lượng công việc đòi hỏi khắt khe nhất. ', 10990000, 50),
('CASE1', 'Cooler Master', 'Thùng máy/ Case CM MasterBox TD500 TG Mesh White ARGB', 'https://lh3.googleusercontent.com/yuTzE0L7y43XmoTUs41Fc4FaT124nnMFR1cKOnsZv2JccwN5t6OHn1vdqKwZW4JJFUT4EzfU6N75e50bOwI=w500-rw', 'Case CM MasterBox TD500 TG Mesh ARGB được sản xuất bởi Cool Master, nhà sản xuất phần cứng máy tính tại Đài Loan. Được thành lập vào năm 1992, sản xuất vỏ máy tính, nguồn, bộ làm mát... Các sản phẩm của Cooler Master mang chất lượng tốt và đều được đánh giá cao của người tiêu dùng và các chuyên gia.', 2220000, 50),
('CASE1', 'Cooler Master', 'Thùng máy/ Case CM MasterBox MB520 TG ARGB', 'https://lh3.googleusercontent.com/BXU_A8XGfiEmR3kBEBg4juMilmMobw28cSY76jSO8-eL7nfHOK2w9HPTlrJ9BNh4BMkyUTAS-0vMff4H1Dw=w500-rw', 'Case CM MasterBox MB511 TG ARGB được sản xuất bởi Cool Master, nhà sản xuất phần cứng máy tính tại Đài Loan. Được thành lập vào năm 1992, sản xuất vỏ máy tính, nguồn, bộ làm mát... Các sản phẩm của Cooler Master mang chất lượng tốt và đều được đánh giá cao của người tiêu dùng và các chuyên gia.', 2120000, 50),
('CASE1', 'CORSAIR', 'Thùng máy/ Case Corsair 465X White (CC-9011189-WW)', 'https://lh3.googleusercontent.com/XLKC6R5VgWO4kSdkf7EGApJ0DIZXD3xWZAWunaurKJospKtFPLfVCG2Uq5M5-C6JbjuQiZA85RvolF3BiVQ=w500-rw', 'Case Corsair 465X White được sản xuất bởi Corsair - 1 công ty tại Mỹ chuyên thiết kế, sản xuất các bàn phím, chuột, tai nghe và ghế gaming, đang được ưa chuộng bởi các game thủ Việt hiện nay do thiết kế hiện đại, bắt mắt với giá thành hợp lý.', 3390000, 50),
('CASE1', 'CORSAIR', 'Thùng máy/ Case Corsair SPEC-DELTA RGB (CC-9011166-WW)', 'https://lh3.googleusercontent.com/D6b5Kfzs6Isg55mD_dz6ZpIpqm__f4WQaTcR9Lh3HV7sOcTCiU2wBKQU4AhWd8fwy0tmBAp7SbwdfWftJ8bW=w500-rw', 'Case máy tính Corsair SPEC-DELTA RGB được sản xuất bởi Corsair - 1 công ty tại Mỹ chuyên thiết kế, sản xuất các bàn phím, chuột, tai nghe và ghế gaming, đang được ưa chuộng bởi các game thủ Việt hiện nay do thiết kế hiện đại, bắt mắt với giá thành hợp lý.', 1790000, 50),
('CASE1', 'DEEPCOOL', 'Thùng máy/ Case Deepcool Matrexx 70', 'https://lh3.googleusercontent.com/T1GfPPe6Mq0H3xfP8l59oNHSPySax7yOIuGImaRtFQq4vE9tfAQygY1dj0SjNTllWxpbWLZv_B6Xd5BTbNA=w500-rw', 'Case Deepcool Matrexx 70 được sản xuất bởi Deepcool, nhà sản xuất phần cứng máy tính tại Trung Quốc. Được thành lập tại Bắc Kinh vào năm 1996, sản xuất vỏ máy tính, nguồn, bộ làm mát... Các sản phẩm của Deepcool mang chất lượng tốt và đều được đánh giá cao của người tiêu dùng và các chuyên gia.', 1750000, 50),
('CASE1', 'DEEPCOOL', 'Case máy tính DEEPCOOL Matrexx 70-RGB 3F - Mid Tower (Đen)', 'https://lh3.googleusercontent.com/8iwmmpt-rLcW2g6YdOBM7_2fSphm9U2LL96guf_fPm-sqsJ55qRkEMJqv5WgfdhUs-PgpIihhtIPKD20fZZS=w500-rw', 'Thùng máy/ Case Deepcool Matrexx 70-RGB 3F được thiết kế và sản xuất bởi hãng Deepcool - là một công ty chuyên về thiết kế, phát triển và sản xuất các sản phẩm tản nhiệt cho PC, laptops và máy chủ server hoặc case máy tính. Công ty được thành lập vào năm 1996 và có trụ sở đặt tại Bắc Kinh, Trung Quốc.', 2250000, 50),
('COOL1', 'Cooler Master', 'Tản nhiệt khí Cooler Master Hyper 212 RGB', 'https://lh3.googleusercontent.com/kuAz3Th1nwq2_p0VQ5sq_HbxjIQryqT_APrCSukm0WG1OgHn7M4mfOlqV9vIQbauQ1ssLzQRhHMNSJCpk2g=w500-rw', 'Đang cập nhật ...', 590000, 50),
('COOL1', 'DEEPCOOL', 'Tản nhiệt nước Deepcool Gammaxx L240 V2', 'https://lh3.googleusercontent.com/Htf_SRcPNH0ua5CIL3cEIcGBDEgj44Uz06S9QpiMBGKcyuZWpBWzfTLZI6prVtA0leTllSSKRvoNRTf1AQ=w500-rw', 'Đang cập nhật ...', 1790000, 50),
('COOL1', 'Cooler Master', 'Tản nhiệt khí Cooler Master Hyper 212 Spectrum', 'https://lh3.googleusercontent.com/rXOHILLO5Ge-GBMZlQoxmTmcqe9D5IyhogzjL0YWYd27NbHgiYKjXZKApOKYBIEt0tAfMHdi_5fx_eKSTx2t=w500-rw', 'Đang cập nhật ...', 850000, 50),
('COOL1', 'ASUS', 'Tản nhiệt nước AIO ASUS TUF LC 240 RGB (Đen)', 'https://lh3.googleusercontent.com/54h_RQP5KjvuCs0wnrooIOx_GRTXCQU4w7zcbCNJY2GEQ2UJSaBB9riGfgms0r9AktWI8NCC0DATNMZJGMj3=w500-rw', 'Đang cập nhật ...', 3500000, 50),
('COOL1', 'ASUS', 'Tản nhiệt nước AIO ASUS ROG STRIX LC 360 RGB (Trắng)', 'https://lh3.googleusercontent.com/u3a35VxwN6okMDkHERqnP2WnP3fC39fwlsjYCGPgr7A186tde9tBVo-LB9PW3ZhQUvdvZwP5-MDh4KgPB-BA=w500-rw', 'Đang cập nhật ...', 7490000, 50),
('MAIN1', 'GIGABYTE', 'Mainboard GIGABYTE B365M GAMING HD', 'https://lh3.googleusercontent.com/RDzdF-se6u0dKQKqCalwWin6o-xrCefhlzwd6jbnhwYVoq89-NMVHf7kOWmKrMGNmT5YTQ7paUOR87L0Pg=w500-rw', 'Realtek 8118 LAN là chip mạng thân thiện và hiệu suất cao dành cho game thủ với khả năng phân bổ băng thông tự động để đảm bảo mức ưu tiên mạng cao nhất cho trò chơi hoặc ứng dụng. Nó có thể cung cấp cho người dùng các tính năng toàn diện nhất và trải nghiệm Internet nhanh và mượt mà nhất.', 1750000, 50),
('MAIN2', 'GIGABYTE', 'Mainboard GIGABYTE AB350-Gaming 3', 'https://lh3.googleusercontent.com/EP2up5LSCZ1ccWg9ONrFSEGAiZTOcHvwmMVmmtXhYURXdwKsDFSQB77KbUYkvGSx-bli_hrVHrVnXtoja_Yg=w500-rw', 'GIGABYTE AB350-GAMING 3 là cái tên khá nổi bật trong số các mẫu bo mạch chủ tầm trung dành cho nền tảng AM4 (Ryzen). Điểm mình đánh giá cao ở sản phẩm này là ngoài những tính năng cơ bản của chipset B350, chúng ta còn có các tính năng đặc trưng đến từ GIGABYTE. Trong số đó có thể kể đến thiết kế cách điệu đẹp mắt cùng khả năng các nhân hoá hê thống đèn LED Fusion theo ý của người dùng.', 2850000, 50),
('MAIN2', 'MSI', 'Mainboard MSI A320M-A PRO MAX', 'https://lh3.googleusercontent.com/PWgB6pmvG1pSP_FwEy50Zi_u7Fa-HsKvvFEjV5G-H5zNVep4tevCPQe6bRH49pCs9TQUXyryG8ksTYT1rw=w500-rw', 'Các bo mạch chủ MSI có hàng tấn thiết kế thông mình và cực kỳ tiện lợi, chẳng hạn như khu vực ngăn chặn và nhận biết chân cắm pin cực kỳ thuận tiện, vị trí SATA & USB thân thiện, v.v., vì vậy người dùng có thể tự tay lựa chọn và build bất kỳ thiết bị chơi game nào họ muốn.\r\n\r\n', 1390000, 50),
('MAIN2', 'MSI', 'Mainboard MSI A320M GAMING PRO', 'https://lh3.googleusercontent.com/wWcPE1WEmMWOe-EmryR5m8hmJe_u3o3q8HQql7mnWk99Hu1j4EyZxuEZj4zjhanxSByQAquLkiftNGw0q2c5=w500-rw', 'ỗ trợ AMD® Ryzen thế hệ 1 và 2 / Ryzen ™ với Radeon ™ Vega Graphics / Athlon ™ với bộ xử lý Radeon ™ Vega Graphics và A-series / Athlon ™ X4 cho Socket AM4\r\nDDR4 Boost: Công nghệ ép xung tiên tiến được cung cấp bởi phòng thí nghiệm MSI, đảm bảo khả năng tương thích tối đa cho khả năng ép xung..\r\n\r\n', 2150000, 50),
('MAIN1', 'ASUS', 'Mainboard ASUS Z490 ROG MAXIMUS XII APEX', 'https://lh3.googleusercontent.com/2nIpDgSdLLM_Jtjb_mayRR9fh5AX999IzuGDuYaXc51uJw91-8mqomNoZY1Hth7ASKITqHWM1HO6bh7M7W4=w500-rw', 'Bo mạch chủ ASUS ROG MAXIMUS XII APEX với khả năng làm mát toàn diện và tính năng cấp điện cải tiến nhằm cung cấp năng lượng cho các vi xử lý đa nhân cùng tính năng hỗ trợ lưu trữ và bộ nhớ nhanh hơn, sẽ mang đến cho bạn tất cả mọi thứ cần thiết để phát huy tối đa sức mạnh của các linh kiện trong giàn máy của bạn nhằm đạt được hiệu năng chơi game tốt nhất.', 11210000, 50),
('PSU01', 'Cooler Master', 'Nguồn máy tính Cooler Master Elite V3 230V PC400 Box - 400W', 'https://lh3.googleusercontent.com/kNUdaIDdwGlTyy55b3EnXPkD7k0vtSNKQK44a-er7hCNnX_YX1-sVfn-zkA6a6PubiVKQSsqdf5eOPs3G9g=w500-rw', 'Nguồn máy tính Cooler Master Elite V3 230V PC400 Box là một nguồn máy tính chịu tải công suất cao, kháng nhiệt độ tốt. Có hiệu suất trung bình trên 80% và tương thích với mọi môi trường.', 695000, 50),
('PSU01', 'Cooler Master', 'Nguồn máy tính Cooler Master MWE Gold 750 - 750W - 80 Plus Gold - Full Modular', 'https://lh3.googleusercontent.com/7Ycmutlmx_TwP-iBdOW7wKzoRUH1vM5rNlerr3x6jP8U2SVOlf9dnaZIJCsh3po69Wkt9F3aW_7Zaqj1WQ=w500-rw', 'MWE Gold 750 - Full Modular là bộ nguồn cao cấp đến từ Cooler Master với tổng công suất lên tới 750W, phù hợp với các cấu hình chơi game hoặc làm việc có công suất tiêu thụ lớn.', 3640000, 50),
('PSU01', 'SEASONIC', 'Nguồn máy tính Seasonic M12II-520 Evo - 520W - 80 Plus Bronze - Full Modular', 'https://lh3.googleusercontent.com/7Ycmutlmx_TwP-iBdOW7wKzoRUH1vM5rNlerr3x6jP8U2SVOlf9dnaZIJCsh3po69Wkt9F3aW_7Zaqj1WQ=w500-rw', 'Nguồn/ Power Seasonic 520W M12II-520 EVO  là sản phẩm tầm trung cho phân khúc khách hàng tìm kiếm nguồn cung cấp năng lượng với độ tin cậy và hiệu quả cao. Thiết kế bán mô-đun cung cấp các kết nối cơ bản của một chiếc nguồn ổn định trong khi cho phép kết nối linh hoạt với thiết bị ngoại vi khác. Hệ số dạng ATX tiêu chuẩn và ở mức công suất phổ biến nhất cho một hệ thống PC.', 2640000, 50),
('PSU01', 'Super Flower\r\n', 'Nguồn máy tính Super Flower Leadex III - 750W - 80 Plus Gold - Full Modular', 'https://lh3.googleusercontent.com/RhTQlSm1ydHBj48j8rJTyQQrq5eZFRqWyHLDid9cWmnEn5B8jNLY-iNlH_KrVwmNSzQW-H1u_GJmKufY9W8=w500-rw', 'Nguồn máy tính Super Flower Leadex III Gold 750W (SF-750F14HG) được chứng nhận 80PLUS Gold với thiết kế cáp Modular đầy đủ 100%, là một linh kiện máy tính tuyệt vời để tối đa hóa quản lý cáp & đầu nối của PSU, đem lại giải pháp định tuyến cáp tốt nhất, đồng thời cũng giúp tăng lưu lượng không khí trong thùng máy làm cho hệ thống của bạn luôn mát mẻ.', 2890000, 50),
('VGA01', 'ASUS', 'Card màn hình ASUS TUF Gaming GeForce GTX 1660 SUPER OC Edition 6GB GDDR6', 'https://lh3.googleusercontent.com/ef7FDJdmXZlWPfWBnWiuQW5dvMI8M1b4Ct8Z0rakh0dKk5w3BuXJd5xMToXZdsDaVHSWTFWIIA4anSOcvqE=w500-rw', 'Card đồ họa ASUS TUF Gaming GeForce GTX 1660 SUPER OC Edition với kết cấu đơn giản và các tính năng được tinh giản những vẫn không ảnh hưởng đến hiệu năng, hai quạt tản nhiệt chống bụi mạnh mẽ cùng với các linh kiện PCB được lắp ráp bằng quá trình sản xuất tự động hóa. Do đó chiếc card đồ họa này được lựa chọn để trở thành thế hệ mới nhất của cạc đồ họa hiệu năng, với mục đích tạo ra một cỗ máy có hiệu suất bền bỉ.', 5990000, 50),
('VGA01', 'GIGABYTE', 'Card màn hình GIGABYTE GeForce GTX 1650 4GB GDDR5 OC (GV-N1650OC-4GD)', 'https://lh3.googleusercontent.com/6Arw92aVenJhYmwUj7P-8pLTxemAcxym_l3tV_1ZJ-md9vzNypDYYvz8bMX39qSiekVKoeEckdv0k_hGPpc=w500-rw', 'GeForce GTX 1650 4GB GDDR5 OC là mẫu card màn hình tầm trung mới nhất của GIGABYTE, với hiệu năng chơi game được cải thiện rất nhiều so với thế hệ trước là GTX 1050Ti đem lại trải nghiệm chơi game mượt mà trên độ phân giải full HD.', 4650000, 50),
('VGA01', 'MSI', 'Card màn hình MSI GeForce GTX 1050Ti 4GB GDDR5 OCV1 (GTX-1050-Ti-4GT-OCV1)', 'https://lh3.googleusercontent.com/G4riNbhKYZYznOOEFU5widbsTs8SmeO1-SnPU03GwEn4uK9LFBiATG4FrQNpZS_w0lOWTr1-66iNpL8jsd4=w500-rw', 'GeForce GTX mang lại hiệu quả chơi game tuyệt nhất, sử dụng công nghệ tiên tiến nhất (NVIDIA GameWorks™) tạo nên môi trường chơi game tốt nhất (GeForce Experience™).', 4890000, 50),
('VGA01', 'MSI', 'Card màn hình MSI GeForce GTX 1650 SUPER VENTUS XS OC 4GB GDDR6', 'https://lh3.googleusercontent.com/xtPO4QMVWwduMSmwRAPjE2RvcqgkciH9puKzi0CVs-ogoBYcFvlh0AxoCsEQXMf-EDq5orQ8P0Bflp-alA=w500-rw', 'Sự trở lại rất được mong đợi đến từ card đồ họa MSI GeForce GTX 1650 SUPER VENTUS XS OC với thiết kế quạt tản nhiệt kép mang tính biểu tượng của MSI. Kết hợp hoàn hão giữa màu đen và màu xám gunmetal với tấm ốp kim loại được thiết kế phay xước, sự hoàn hảo này mang đến cho bạn thiết kế cao cấp và mượt mà ở lớp vỏ, đảm bảo đem lại sự ấn tượng mạnh mẽ cho bạn và mọi người xung quanh.', 5350000, 50),
('VGA01', 'ASUS', 'Card màn hình ASUS ROG Strix RTX 2060 Super OC EVO 8GB GAMING', 'https://lh3.googleusercontent.com/tTPv_l7cVlZzILCIqzk8iSqXaSAt2iw-NVzRDqznycUCBu-GINyv5LLQDZiUPpz25M7kjyW03st701tbzWw=w500-rw', 'ASUS ROG Strix RTX 2060 SUPER OC EVO 8GB GAMING là thế hệ card đồ họa mới mang lại trải nghiệm chơi game tuyệt đỉnh nhờ việc được trang bị nhiều nhân CUDA hơn và được tích hợp nhiều tính năng hàng đầu. Được xây dựng dựa trên kiến trúc Turing giúp đem lại hiệu năng xử lý mạnh mẽ và khả năng ép xung vượt trội, đồng thời vẫn đảm bảo duy trì khả năng tản nhiệt hiệu quả. Việc làm chủ hoàn toàn các tựa game AAA sẽ trở nên dễ dàng hơn bao giờ hết.', 14180000, 50),
('VGA02', 'GIGABYTE', 'Card màn hình GIGABYTE Radeon RX 5600 XT Gaming OC 6GB GDDR6', 'https://lh3.googleusercontent.com/w5ygwO3wsFDzIhVFMIYFUD8C9LfKeC5G8uasjAqDvrzet3BVZ6geLigDbF5DaRt7JjWAsSvqLC-nj_Z2qcE=w500-rw', 'Card đồ họa GIGABYTE Radeon RX 5600 XT Gaming OC 6GB GDDR6 với hệ thống tản nhiệt WINDFORCE 3X độc quyền có các cánh quạt 80mm được thiết kế độc đáo, quay xen kẽ với nhau, 5 ống dẫn nhiệt bằng đồng, ống dẫn nhiệt tiếp xúc trực tiếp và chức năng quạt hoạt động 3D, cùng nhau mang lại khả năng tản nhiệt hiệu quả, cho hiệu suất cao hơn ở nhiệt độ thấp hơn.', 8990000, 50),
('VGA02', 'GIGABYTE', 'Card màn hình GIGABYTE Aorus Radeon RX5700XT 8GB GDDR6', 'https://lh3.googleusercontent.com/lpI_Bvc3C6sJgQrT74nylJEgzYGN2uCpyrFfoz5VXzZbfVy7KCI4YsjBlD5XRABk8iR6LtOlNMOzq4WOOA=w500-rw', 'GIGABYTE AORUS Radeon RX5700XT 8GB GDDR6 là mẫu card đồ họa cao cấp mới nhất của GIGABYTE, sử dụng nền tảng xử lý đồ họa AMD mới nhất với hiệu năng mạnh mẽ đi kèm với nhiều công nghệ đồ họa tiên tiến nhất hiện nay. Kết hợp với hệ thống tản nhiệt AORUS độc quyền của GIGABYTE đem lại giải pháp tản nhiệt hoàn hảo.', 12890000, 50),
('VGA02', 'ASUS', 'Card màn hình ASUS ROG Strix Radeon RX 5700 OC 8GB GDDR6 (ROG-STRIX-RX5700-O8G-GAMING)', 'https://lh3.googleusercontent.com/jHExHywD5a9Mmd1EooZ-pM6iWvMjvggly9fxYWvZUPtlurzO23mQgZSD6yofzDuCh7XFSR2Xs3C9O6eSrw=w500-rw', 'Card màn hình ASUS ROG Strix Radeon RX 5700 OC được thiết kế để thống trị dòng game hạng nặng 1440p nhờ hiệu năng xử lý mạnh mẽ và các tính năng hỗ trợ gaming hàng đầu như công nghệ tản nhiệt MaxContact, chống bụi IP5X, khung gia cường và nhiều thứ khác nữa.', 12890000, 50),
('RAM01', 'CORSAIR', 'RAM desktop CORSAIR DOMINATOR Platinum RGB CMT16GX4M2C3000C15 (2x8GB) DDR4 3000MHz', 'https://lh3.googleusercontent.com/lw8uRa7vXOfx8OLaBg-AjISoaJNNTEzHZGKQ7xO7HXRt7Jhcem-v3wL0wDKh39P32geLsZ1asq9uIHhjaQ=w500-rw', 'Với bề dày kinh nghiệm hơn 25 năm tham gia trong ngành công nghệ máy tính, đặc biệt là ngành chế tạo các thiết bị lưu trữ và bộ nhớ, Corsair đã có rất nhiều đóng góp cho ngành công nghệ máy tính thế giới. Và mới đây, bằng trí tuệ, tâm huyết và khả năng áp dụng công nghệ mới, hãng đã cho ra đời thế hệ RAM DDR4 mới – DOMINATOR Platinum RGB.', 3190000, 50),
('RAM01', 'ADATA', 'RAM desktop ADATA XPG GAMMIX D10 AX4U266638G16-SRG (1x8GB) DDR4 2666MHz', 'https://lh3.googleusercontent.com/5GWD3l5L9JKlFpEdD1cOKt-AtpeEloVsLGPWeJWhoz8s4nyuWcnFpXTZPobzh-y-F_2EUJB1urCsA6pIzQ=w500-rw', 'RAM Adata Gammix D10 8GB (2666) AX4U266638G16-SRG (Đỏ) là dòng RAM được thiết kế cho các game thủ và những người đam mê PC cùng với sự hỗ trợ cho việc triển khai tốc độ bộ nhớ cơ bản cho hệ thống Intel X299. Với bảng mạch in (PCB) 10 lớp, dòng D10 cải thiện chất lượng truyền tín hiệu và duy trì hoạt động ổn định mọi lúc. RAM cũng hỗ trợ Intel XMP 2.0 để ép xung nhanh và an toàn hơn. Gammix D10 với thiết kế lớp áo tản nhiệt hình răng cưa cá tính và độc nhất, vừa cho hình thức nổi bật vừa cho hiệu suất tản nhiệt tuyệt vời. Chiều cao của RAM phù hợp với tất cả các kích thước của mọi hệ thống PC, có thể lắp đặt cho cả các hệ thống có không gian lắp đặt hạn chế.', 1190000, 50),
('RAM01', 'Kingston', 'RAM desktop KINGSTON HyperX Fury RGB 16GB (2 x 8GB) DDR4 3200MHz (HX432C16FB3AK2/16)', 'https://lh3.googleusercontent.com/3aULB-0jiFUg7oF4bz7MlcTsqWryj3jvlczRr864ClS505mHzMTf2ty5cDh8UZhRzck0Waf6fylhvklGKkhV=w500-rw', 'Với thiết kế nam tính với các nét cắt, đường vân, cứng cáp chắc chắn tạo cho người dùng an tâm khi sử dụng sản phẩm. Kèm theo đó là sự thể hiện cá tính cùng với FURY RGB.', 2490000, 50),
('RAM01', 'Kingston', 'RAM desktop KINGSTON HyperX Predator RGB Kit 32GB (2 x 16GB) DDR4 3200MHz (HX432C16PB3AK2/32)', 'https://lh3.googleusercontent.com/Te60twlxJe4_cprmb1wnlD9_dRtuLAZ_AT3GhSLFgbu97aKXMRwP0_mwHMyvjGS6K6UjwLUfEEALzlki7pkl=w500-rw', 'RAM Kingston HyperX Predator RGB Kit là một lựa chọn hoàn hảo để nâng cấp cho game thủ muốn một hiệu năng chơi game tối đa cùng phong cách đèn RGB cá tính rực rỡ trong hệ thống của mình. Tấm tản nhiệt đen phong cách kết hợp với bo mạch chủ cùng màu sẽ đánh bay cái nóng và gây sợ hãi cho kẻ thù.', 5290000, 50),
('SSD01', 'Samsung', 'Ổ cứng SSD Samsung 860 QVO 1TB 2.5\" (Mz-76Q1T0BW)', 'https://lh3.googleusercontent.com/B7jlSC4v1c1sgU9AWA8Gu1_G7ojPZ8TddteVnkBkFj5fWCRqMxQF4Eu6T0B-c2S7xGypqBe6aO333nRJuw4=w500-rw', 'Ổ cứng SSD Samsung 860 QVO 1TB 2.5\" cung cấp cho bạn dung lượng lưu trữ Terabyte lớn với hiệu suất cao và thiết kế vững chắc để đem giá trị đặc biệt. Bước đột phá này đã đạt được với công nghệ flash MLC NAND 4 bit mới nhất của Samsung. Bây giờ là lúc để nâng cấp hoặc mở rộng lên SSD tốc độ nhanh mà bạn cần.', 4480000, 50),
('SSD01', 'KINGSTON\r\n', 'Ổ cứng SSD Kingston 256GB 2.5\" Sata (SKC600/256G)', 'https://lh3.googleusercontent.com/-C4Fap7lJhm2lQWROIX5EdtQg5xcLiksfcawrGZHgGOL-saPv0d_jEkpcvfbKuxtAzqD8hnRIUAFtDlKBA=w500-rw', ' Ổ cứng SSD Kingston 256GB 2.5\" Sata (SKC600/256G) của Kingston là một ổ lưu trữ SSD có dung lượng đầy đủ được thiết kế để mang lại hiệu năng xuất sắc và được tối ưu để mang lại độ phản hồi hệ thống vượt trội với thời gian khởi động, tải và truyền đáng kinh ngạc.', 1480000, 50),
('SSD01', 'KINGSTON\r\n', 'Ổ cứng SSD Kingston 1024GB 2.5\" Sata (SKC600/1024G)', 'https://lh3.googleusercontent.com/u9AEwpzRI_ILRYGIlv65aZLENJE7j_-mOlaIoIqO3-LPikWYqQt-YhroSyG18msYhLpbswT9zNrTCeq6YHS3=w500-rw', ' Ổ cứng SSD Kingston 1024GB 2.5\" Sata (SKC600/1024G) của Kingston là một ổ lưu trữ SSD có dung lượng đầy đủ được thiết kế để mang lại hiệu năng xuất sắc và được tối ưu để mang lại độ phản hồi hệ thống vượt trội với thời gian khởi động, tải và truyền đáng kinh ngạc.', 3500000, 50),
('SSD01', 'WD', 'Ổ cứng SSD WD Blue SN550 500GB M.2 2280 NVMe Gen3 x4 (WDS500G2B0C)', 'https://lh3.googleusercontent.com/w6trFwUrOOu2-vSwZ5NbBZtH3v5JHzhjrDYq9xeHqstVSIosD1_iMNuFxEdkxo-cqISesyvm10DSZtCdwl4=w500-rw', ' WD (Western Digital) là một thương hiệu về sản xuất sản phẩm lưu trữ dữ liệu toàn cầu, cho phép mọi người tạo, quản lý, lưu trữ dữ liệu trên nhiều thiết bị. Hàng triệu người sử dụng trên thế giới đã và đang tin tưởng sử dụng các sản phẩm của WD. Ổ cứng SSD WD Blue SN550 500GB M.2 2280 NVMe Gen3 x4 (WDS500G2B0C) với công nghệ tốt hơn đi kèm chắc chắn sẽ làm hài lòng người sử dụng.', 3500000, 50),
('HDD01', 'WD', 'ổ cứng HDD NAS WD Red 4TB Sata3 5400rpm (WD40EFAX)', 'https://lh3.googleusercontent.com/5itHSgV1dxliQcYoSatSpwcCv7XRnY8-9QLZCU5meyr7JGGMVCzTzkp95DV0dNaCmvL6IE6P9khLOHsL6hos=w500-rw', 'ổ cứng HDD NAS WD Red 4TB Sata3 5400rpm được trang bị dung lượng lên đến 4TB giúp bạn thoải mái lưu trữ dữ liệu quan trọng. Đảm bảo hoạt động tốt nhất cho chiếc máy tính của bạn khi lưu trữ hình ảnh, nhạc, phim...', 3390000, 50),
('HDD01', 'SEAGATE\r\n', 'Ổ cứng HDD Seagate Barracuda 1TB 3.5\" SATA 3 - ST1000DM010', 'https://lh3.googleusercontent.com/yM1w_gitNAQySU4yoeo8WWsUvWQyH0je5-g0kzSzz6IR0iKYihExNww4lGJQBEd6KTB8JLTQQumHJMLg3NQ=w500-rw', 'Ổ cứng truyền thống HDD với ưu thế là độ bền và dung lượng cao vẫn là một phần không thể thiếu được trong một chiếc máy tính. Đặc biệt là trong thời đại công nghệ hiện nay, những dữ liệu được xử lý ngày càng phức tạp và đồ sộ. Những bộ phim với độ nét cao, những tựa game khủng với dụng lượng hàng chục Gb đang choán khá nhiều chỗ khiến người dùng máy tính phải đau đầu với việc lưu trữ rất nhiều thứ một lúc.', 3390000, 50),
('HDD01', 'SEAGATE\r\n', 'Ổ cứng HDD PC Seagate Barracuda 6TB 3.5\" SATA (ST6000DM003)', 'https://lh3.googleusercontent.com/RaqgS1ZYPond1ymDik6LJGmSz0gA3X5Wn2fycNUkkMhs_hUDPRSuVaIHcwj5QcYGCamAE0yCBE1r5CwyASVw=w500-rw', 'Ổ cứng truyền thống HDD với ưu thế là độ bền và dung lượng cao vẫn là một phần không thể thiếu được trong một chiếc máy tính. Đặc biệt là trong thời đại công nghệ hiện nay, những dữ liệu được xử lý ngày càng phức tạp và đồ sộ. Những bộ phim với độ nét cao, những tựa game khủng với dụng lượng hàng chục Gb đang choán khá nhiều chỗ khiến người dùng máy tính phải đau đầu với việc lưu trữ rất nhiều thứ một lúc.', 4450000, 50),
('HDD01', 'SEAGATE\r\n', 'Ổ cứng HDD Seagate Barracuda 4TB 3.5\" SATA 3 - ST4000DM004', 'https://lh3.googleusercontent.com/TgyBNVmGM3D1v4cTDbEQrtPoaqLr9xLHumtB-Sm69COZLKfiu0EtZLufL0z_uouyq52MofmgmYycs9TrbTE=w500-rw', 'Ổ cứng truyền thống HDD với ưu thế là độ bền và dung lượng cao vẫn là một phần không thể thiếu được trong một chiếc máy tính. Đặc biệt là trong thời đại công nghệ hiện nay, những dữ liệu được xử lý ngày càng phức tạp và đồ sộ. Những bộ phim với độ nét cao, những tựa game khủng với dụng lượng hàng chục Gb đang chiếm khá nhiều bộ nhớ. Khiến người dùng máy tính phải đau đầu với việc lưu trữ rất nhiều thứ một lúc. Hướng tới đối tượng người dùng phổ thông, BarraCuda vốn đã rất quen thuộc với người dùng các sản phẩm ổ cứng Seagate từ hơn 20 năm nay. Tuy nhiên ở phiên bản mới, Seagate muốn hướng đến người dùng đề cao tốc độ, sự chính xác và tiết kiệm điện năng cho nhu cầu làm việc và giải trí.', 2850000, 50),
('HDD01', 'SEAGATE\r\n', 'Ổ cứng HDD Seagate 2TB 3.5\" SATA 3 - ST2000DM008', 'https://lh3.googleusercontent.com/WdXJQCE7jPenUcPp2sBbICPD54hlbfxJvpKN7TFcJ-R-bkNCfMTxaRs9G1GhBHwrZKr4-4gdCMGC4jMe0B0=w500-rw', 'Ổ cứng HDD PC Seagate BarraCuda 2TB 3.5 inch SATA (ST2000DM008) được thiết kế và sản xuất bởi hãng Seagate (tên đầy đủ là Seagate Technology) - là 1 trong những công ty chuyên về nghiên cứu, phát triển và sản xuất kho lưu trữ dự liệu lớn trên thế giới. Seagate được thành lập vào tháng 1 năm 1979 với tên ban đầu là Shugart Technology, công ty được hợp nhất tại Ai-len và có các văn phòng điều hành chính được đặt tại California, Mỹ từ năm 2010. ', 1650000, 50);
create table tblOrderInvoice
(
	OrderID int primary key AUTO_INCREMENT,
	OrderDate datetime not null default current_timestamp(),
	OrderAddress varchar(255) not null,
	OrderTotalMoney int default 0,
	TelNo char(10) not null,
	CustNo int not null,
	OrderStatus tinyint(1) default 0,
  FOREIGN KEY (CustNo) REFERENCES tblCustomer(CustID)
) ENGINE = InnoDB;

create table tblOrderInvoiceDetail
(
	OrderID int not null,
	ProductID int not null,
	QtyOrdered int default 0,
	Amount int default 0,
  primary key(OrderID, ProductID),
  FOREIGN KEY (OrderID) REFERENCES tblOrderInvoice(OrderID),
  FOREIGN KEY (ProductID) REFERENCES tblProduct(ProductID)
) ENGINE = InnoDB;

CREATE TABLE tblCart (
  	CartID int primary key AUTO_INCREMENT,
	CustNo int NOT NULL,
  FOREIGN KEY (CustNo) REFERENCES tblCustomer(CustID)	
) ENGINE=InnoDB;

create table tblCartDetail
(
	CartID int not null,
	ProductID int not null,
	QtyOrdered int,
  primary key(CartID, ProductID),
  FOREIGN KEY (CartID) REFERENCES tblCart(CartID),
  FOREIGN KEY (ProductID) REFERENCES tblProduct(ProductID)
) ENGINE = InnoDB;

CREATE TABLE tblAdmin (
  AdminID int primary key AUTO_INCREMENT,
  AdminName varchar(255) NOT NULL,
  AdminUser varchar(255) NOT NULL,
  AdminEmail varchar(255) NOT NULL,
  AdminPass varchar(32) NOT NULL,
  AdminLevel tinyint not null
)ENGINE = InnoDB;

INSERT INTO tblAdmin VALUES (1, 'Trần Quang Đăng', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 0)
/*
DROP TRIGGER IF EXISTS trgInsert_OrderInvoiceDetail;
DROP TRIGGER IF EXISTS trgDelete_OrderInvoiceDetail;
DELIMITER $$
create trigger trgInsert_OrderInvoiceDetail
after insert on tblOrderInvoiceDetail
FOR EACH
ROW
begin
	update tblOrderInvoiceDetail
	set Amount = QtyOrdered * UnitPrice
	where
		tblProduct.ProductID = new.ProductID and
		tblOrderInvoiceDetail.OrderID = new.OrderID and
		tblOrderInvoiceDetail.ProductID = new.ProductID;
END$$

 DELIMITER ;


DROP TRIGGER IF EXISTS trgInsert_OrderInvoiceDetail;
DROP TRIGGER IF EXISTS trgDelete_OrderInvoiceDetail;
DELIMITER $$
create trigger trgInsert_OrderInvoiceDetail
after insert on tblOrderInvoiceDetail
FOR EACH
ROW
begin
	update tblOrderInvoiceDetail
	set Amount = QtyOrdered * UnitPrice
	where
		tblProduct.ProductID = new.ProductID and
		tblOrderInvoiceDetail.OrderID = new.OrderID and
		tblOrderInvoiceDetail.ProductID = new.ProductID;
END$$

 DELIMITER ;

DELIMITER $$
create trigger trgDelete_OrderInvoiceDetail
after delete on tblOrderInvoiceDetail
FOR EACH
ROW
begin
	update tblOrderInvoiceDetail
	set tblOrderInvoiceDetail.Amount = tblOrderInvoiceDetail.QtyOrdered * tblProduct.UnitPrice
	where
		tblProduct.ProductID = old.ProductID and
		tblOrderInvoiceDetail.OrderID = old.OrderID and
		tblOrderInvoiceDetail.ProductID = old.ProductID;
END$$

 DELIMITER ;

DELIMITER $$
 CREATE TRIGGER trg_TotalMoney
   after update on tblOrderInvoiceDetail
FOR EACH
ROW
BEGIN
    UPDATE tblOrderInvoice
	set tblOrderInvoice.OrderTotalMoney = (select sum(tblOrderInvoiceDetail.Amount) where tblOrderInvoice.OrderID = tblOrderInvoiceDetail.OrderID);
END$$

 DELIMITER ;*/

