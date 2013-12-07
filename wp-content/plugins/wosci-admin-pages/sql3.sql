CREATE DEFINER=`root`@`localhost` FUNCTION `HexColorDistanceone2`(Q_r INT, Q_g INT, Q_b INT, DB_r INT, DB_g INT, DB_b INT) RETURNS int(11)
BEGIN
  RETURN (( ( 1-( ABS((( DB_r/255)) - ABS((Q_r/255)))) ) + ( 1-(ABS(((DB_g/255)) - ABS((Q_g/255)))) )  + ( 1-(ABS(((DB_b/255)) - ABS((Q_b/255)))) ) ) /3*100);
END