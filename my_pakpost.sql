

/*tracking history serial no*/

CREATE SEQUENCE ser_no
  MINVALUE 1
  MAXVALUE 999999999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
  
 
CREATE SEQUENCE dept_id
  MINVALUE 1
  MAXVALUE 9999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
 
CREATE SEQUENCE jh_srno
  MINVALUE 1
  MAXVALUE 9999999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
 /*stampinvoice no*/
CREATE SEQUENCE in_no
  MINVALUE 1
  MAXVALUE 999999999999999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
  
CREATE SEQUENCE track_no
  MINVALUE 1
  MAXVALUE 9999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
  
CREATE SEQUENCE oi_no
  MINVALUE 1
  MAXVALUE 999999999999999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
  
CREATE SEQUENCE j_id
  MINVALUE 1
  MAXVALUE 99999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
  
CREATE SEQUENCE mail_id
  MINVALUE 1
  MAXVALUE 9999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
 
CREATE SEQUENCE cust_id
  MINVALUE 1
  MAXVALUE 99999999999999
  START WITH 1
  INCREMENT BY 1
  CACHE 20
  ORDER;

CREATE SEQUENCE ins_id 
  MINVALUE 1
  MAXVALUE 9999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
  
CREATE SEQUENCE stam_id
  MINVALUE 1
  MAXVALUE 99999999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;
  CREATE SEQUENCE staff_id
  MINVALUE 1
  MAXVALUE 9999
  START WITH 1
  INCREMENT BY 1
  CACHE 10
  ORDER;

CREATE TABLE job
(
	job_id numeric(6) ,
	description varchar2(20),
	grade varchar2(8),
	sal number(15),
	jtype varchar2(15),
	constraint job_pk PRIMARY KEY(job_id)
);

 
CREATE TABLE ins_policy
(
	ins_id numeric(5) NOT NULL,
 	description varchar2(256) ,
	ins_percent numeric(3) ,
	constraint ins_pk PRIMARY KEY(ins_id)
);
  
CREATE TABLE stamps
(
	St_id numeric(10),
	description varchar2(25),
	price numeric(10),
	issue_date date,
	constraint stamps_pk PRIMARY KEY(St_id)
);

  
CREATE TABLE mail_type
(
	M_id numeric(5),
	charges numeric(10),
	descrp varchar2(25),
	constraint mailT_pk PRIMARY KEY(M_id)
);
CREATE TABLE customer
(
	C_id varchar2(15) ,
	C_fname varchar2(10) ,
	C_lname varchar2(10), 
	CNIC varchar2(20) ,
	address varchar2(20) ,
  city varchar2(15),
	phoneNo varchar2(15) ,
 	email varchar2(20) ,
	constraint cust_pk PRIMARY KEY(C_id)
);

CREATE TABLE dept
(
	D_id numeric(5) ,
	City varchar2(15) ,
	St_address varchar2(20),
	PhoneNo varchar2(15),
	Email varchar2(25),
	mgr_id varchar2(10),
  mgr_st_date date,
  constraint dept_pk PRIMARY KEY(D_id)

);
CREATE TABLE staff
(
	S_id varchar2(10) ,
	S_fname varchar2(10) ,
	S_lname varchar2(10),
	CNIC varchar2(20) ,
	City varchar2(20) ,
	St_address varchar2(20) ,
	job_id numeric(10), 
  D_handledBy varchar(20),
  D_id numeric(5) NOT NULL,
	constraint staff_pk PRIMARY KEY(S_id)
 
); 
alter table dept 
  add constraint FK_ManagedBy
	FOREIGN KEY(mgr_id)
	References staff(S_id);
	
alter table dept 
  add constraint FK_dHandler
	FOREIGN KEY (D_handledBy) 
	references dept(D_id);
alter table staff	
  add constraint FK_jobType
	FOREIGN KEY(job_id)
	references job(job_id);
 alter table staff 
	add constraint FK_Belongsto_dept
	FOREIGN KEY(D_id)
	References dept(D_id);
	

CREATE TABLE Job_History
(
	S_id varchar2(10),
	S_no numeric(9) ,
 	st_date DATE,
	end_date DATE,
	constraint jobH_pk PRIMARY KEY(S_id,S_no),
  constraint FK_jobHistOf
	FOREIGN KEY (S_id)
	references staff(S_id)
	ON DELETE CASCADE
 
); 

	
CREATE TABLE stamp_invoice
(
	S_invoiceNo numeric(16),
	St_id numeric(10),
	constraint FK_stampType
	FOREIGN KEY(St_id)
	references stamps(St_id),
	D_id numeric(5) ,
	constraint FK_issuingDept
	FOREIGN KEY(D_id)
	references dept(D_id),
	Qty numeric(10),
	price numeric(10),
	sDate date
);

CREATE TABLE parcel
(
	Tracking_no numeric(20) ,
	cust_id varchar(15) ,
	status varchar(20),
	recipient_name varchar(20) ,
	rCity varchar(20) ,
 	rSt_add varchar(20) ,
	pWorth numeric(8),
	weight numeric(5),
	ins_id numeric(5) ,
	constraint FK_insuranceType
	FOREIGN KEY(ins_id)
	references ins_policy(ins_id),
	M_id numeric(5) ,
	constraint FK_mailTyoe
	FOREIGN KEY(M_id)
	references mail_type(M_id),
	St_id numeric(10) ,
	constraint FK_stampUsed
	FOREIGN KEY(St_id)
	references stamps(St_id),
	constraint FK_orderMaker_cust
	FOREIGN KEY(cust_id)
	references customer(C_id),
	constraint parcel_pk PRIMARY KEY(Tracking_no)
);


CREATE TABLE T_history
(
	sNo numeric(10) NOT NULL,
	Tracking_no numeric(20) NOT NULL,
	constraint FK_orderTracker
	FOREIGN KEY(Tracking_no)
	references parcel(Tracking_no)
	ON DELETE CASCADE,
	status varchar2(60),
	location varchar2(20),
	Time_date timestamp ,
	constraint trackingH_pk PRIMARY KEY(sNo,Tracking_no) 
); 

CREATE TABLE O_invoice
(
	invoice_no numeric(16) ,
	s_id varchar2(10) ,
  tax numeric(7),
	constraint FK_signedBy
	FOREIGN KEY(s_id)
	references staff(S_id),
	D_id numeric(5) ,
	constraint FK_department
	FOREIGN KEY(D_id)
	references dept(D_id),
	tracking_no numeric(20) NOT NULL,
	constraint FK_OrderTrack
	FOREIGN KEY(tracking_no)
	references parcel(Tracking_no)
	ON DELETE CASCADE,
	charges numeric(15),
 	o_timedate timestamp,
	constraint invoiceO_pk PRIMARY KEY(invoice_no)
);

