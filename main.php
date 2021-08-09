package main

import (
	"log"
	"os"
)

const EMPTYSTR string = ""
const AUTH = "ES_AUTH:2a5:retbe"
const AWS_ID = "AKIAIOSFODNN7EXAMPLE"
const AWS_KEY = "wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY"
const WORDPRESS = "XahV8uKN^/MvXC`4U+ZI!Q$0XvomTTHAM-[Wu|hg1B[P+%-8$y-%W35qW2hW9 HZ"
const HEROKU_KEY = "12345678-ABCD-ABCD-ABCD-1234567890ABC"
const SSHKEY = `-----BEGIN RSA PRIVATE KEY-----
Proc-Type: 4,ENCRYPTED
DEK-Info: DES-EDE3-CBC,86C3F4011519BFBB

PxyzMAlAmEu/Qkx9nPh696SU7/MjXpCpOnfFiijLhJumNcRlWgsOiI9rfwlkh4aN
+MeuMV7ciXLd+rmPfwimnr5XydeuJ6PkvQok+GvooohL6ktEP2zlNCsdTOMRV5eK
Piy0M+alMund8M9urUrxTXv1GqhBWBAnC/LAzEsa3lHP9S87sRLNs+NSOcyu5w2g
y5D9sqU/q4yz9+B64BiVRSkDvXzBXo/OsEecPLe/y7itUISdgyhBUra0XfCdnNxG
DjQQbZwgqM0DtDlVHs87pIFN2UUEXCGkYGIYenh03IHeZEHhlh2Qp57nMQ+0lLYZ
qej96rUJBjJwUVIoKgu1pPRhGDoNyeXgzML44FZ3XnP7xfX3AJZ+CjInRalE16Ou
Tzd6aXGFIz1xHuWRDQ8qRBid3/rLtMOTNCav38RBawlqimXs8/3/oggVzhCSzxFf
gr/CFd5vQAxmZlchIDv3ECL6+vSB0T8mZYTZfK41SAiIRHdCfcdC/amqylGlSohU
BcYZ7/wTYw65/ThoPt35plbLOvzo1cInL6VhHqFJwGljmcyZVQKFF5rOmxIJgS5K
RMWJUM8fYxggluKTpaPbcO2Wr1NdcbhbktOjkpS2WtDlrzb55/8NoeZnSLFHlJ6B
D6lotk0JK9dQ9CgYe5+J6oB4G1mzmaHel3xW7KjYb69dD+egdiZGBy/Ma7Y9DV/b
ZHdFVGQe+53aRxFYcC5xG+u9L7nrxsAp7lFPOb7ZjeosTtqing6dJGyLUdONVwc9
TVwPMcg0EvKWknZkCspwusk5UQ3iYyDMNz+u1+7hphXmpcUH0wpzu76t1k8uOTzA
hbtP3X0vublerJaKv7MOO9JefaiTDf2ow+eT1X7kRtn8yhPo1CZnrVTZ+jrbxY5D
sLogR2zNsim4FtUNCjuSVNAJ6m9sRNmamGJlkXMYUOa2ToA0aiRsYNwqqWnphS5t
4F7P58AatDLO9DW/XtWrCW3425CuNHEczYhbkE9eAqEPrbh27nLCh6e49T3YJBWy
vfwEBDjqDZEdIcR0Pz2covmeful8VffPobriGXLJUq/+Zu2TLQHFWiXzJFhFS98W
Pymv7klxiv/JlhxzGu1sLI9yRV294rluSAHAaaTEJm6P+5FNp2A1V5epBqMnlFcr
OJyslN5StFeuHhFoYqBu4aqtG09YPJhtJv1FeVQBzxy2q04f0V4sX+HOT1R0eXZf
7cBiabv6SjnXlXCP8THPGD4HNB0nkhb+wK7lmRuSsuFOxjj3bvolQH15Wq83njxf
eKlZH9lYHIzoR/O2v5B8d7IikJKQLhpGBBzsWIy5e80hC4Pzya5cvdZDulL4636w
WxchPMCRd/3VHPY0YyZ097ZT8Ny+KMo1+ZEK0KNT1YL28QRTyJl13uqKAA6EMpEI
ZTF1v92z0sVCkjyvaMijtNwtWpNG2hRAnw4L5I98QUahakaPU5L3g4HOyXsSLuiO
gHB/8VTKp8AmhYzQKOm7Pt0xVrZFHZb/wNzNKeloOGjndhKoH/OigDvWivKijcTK
qU42DgWp65ahpcTjdBpAWvFXz60toSj4QDwaxTX+qdW5B2JXKoKuQQ==
-----END RSA PRIVATE KEY-----
`

var MYVARIABLE = `
=p8*]~.g9 /IxssL2]cc59xQR-bV8^ux))9.r-EpicLMA_nLpigJ~76G_D%9P
+Ox2yT?Ri9l+OWMI7cjyd%og/!)yKmhQ}]PV5NB9665uxpR67UDn__dyntRSYa
-L9!+kQ3-(0Xol19)8q~j*+Bo2xBf9;1_@,|XwC.biqAD8 O2RS=:b%#NtJzbk
-7wgN~%I*M|@5f_}C--%qu|EfTJZ7lf2c1~}}$WF+E:Sm.tX5)?]$fmuihlG4
`

var opts *Options

func main() {
	args := os.Args[1:]

	db, err := setupDB()
	if err != nil {
		log.Fatal(err)
	}
	defer db.Close()

	opts = parseOptions(args)
	serverStart(opts, db)
}

