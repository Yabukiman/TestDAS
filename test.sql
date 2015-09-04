# Consulta No. 1

# Subqueries
SELECT TDOC_NOMBRE
FROM TIPO_DOCUMENTO
WHERE TDOC_ID IN (SELECT PARC_NOMBRE
				FROM POE_ARCHIVO
				WHERE POE_ID IN (SELECT POE_ID
								FROM POE))

# Inner join
SELECT TIPO_DOCUMENTO.TDOC_NOMBRE, POE_ARCHIVO.PARC_NOMBRE, POE.POE_ID
FROM TIPO_DOCUMENTO
INNER JOIN POE_ARCHIVO
ON TIPO_DOCUMENTO.TDOC_ID = POE_ARCHIVO.POE_ID
INNER JOIN POE
ON POE_ARCHIVO.POE_ID = POE.POE_ID

# Consulta No. 2

# Subqueries
SELECT DTIP_NOMBRE
FROM DOSIMETRO_TIPO
WHERE DTIP_ID IN (SELECT DOS_MARCA, DOS_MODELO
				FROM DOSIMETRO
				WHERE DOS_ID IN (SELECT POE_ID
								FROM POE
								WHERE POE_ID IN (SELECT PCON_ANIO, PCON_TRIMESTRE, PCON_RESULTA
												FROM POE_CONTROL)))

# Inner join
SELECT DOSIMETRO_TIPO.DTIP_NOMBRE,
		DOSIMETRO.DOS_MARCA,
		DOSIMETRO.DOS_MODELO,
		POE.POE_ID,
		POE_CONTROL.PCON_ANIO,
		POE_CONTROL.PCON_TRIMESTRE,
		POE_CONTROL.PCON_RESULTA
FROM DOSIMETRO_TIPO
INNER JOIN DOSIMETRO
ON DOSIMETRO_TIPO.DTIP_ID = DOSIMETRO.DTIP_ID
INNER JOIN POE
ON DOSIMETRO.POE_ID = POE.POE_ID
INNER JOIN POE_CONTROL
ON POE.POE_ID = POE_CONTROL.POE_ID