SET NOCOUNT ON

/**
* Embaralhar string
*/

DECLARE @STRING      VARCHAR(MAX) = 'SARA GRACIANO DA ROCHA', 
        @NOVA_STRING VARCHAR(MAX) = '',
        @TAM         INT          = 0, 
        @X           INT          = 1, 
        @R           INT          = 0

SET @TAM = LEN(@STRING);

DECLARE @tmp TABLE(CHAVE INT)

WHILE @X <= @TAM
BEGIN

   SET @R = CONVERT(INT,RAND()*@TAM);
  
   IF @R NOT IN (SELECT CHAVE FROM @tmp)
   BEGIN
      SET @NOVA_STRING = @NOVA_STRING + SUBSTRING(@STRING,@R,1);
      SET @X = @X + 1;
      INSERT INTO @tmp VALUES (@R)
   END
   
END

SELECT @STRING AS STRING, @NOVA_STRING AS NOVA_STRING;

