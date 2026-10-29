-- SELECT SUM(quantidade) AS total_pecas FROM pecas;

-- SELECT SUM(preco_unitario * quantidade) AS total_valor_pecas FROM pecas;

-- SELECT MAX(preco_unitario) AS peca_mais_cara FROM pecas;

-- SELECT MIN(preco_unitario) AS peca_mais_barata FROM pecas;

-- SELECT ROUND(AVG(preco_unitario), 2) AS media_preco_pecas FROM pecas;

-- SELECT SUM(preco_unitario * quantidade) AS valor_estoque_eletrica FROM pecas WHERE categoria = 'eletrica';