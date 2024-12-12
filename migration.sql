USE nutricare;

-- Criação da tabela usuario
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    sobrenome VARCHAR(50) NOT NULL,
    data_nascimento DATE NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('admin', 'cliente') NOT NULL
);

-- Criação da tabela dado_paciente com chave estrangeira para usuario
CREATE TABLE dado_paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL UNIQUE,
    altura DECIMAL(5, 2) NOT NULL,
    peso DECIMAL(5, 2) NOT NULL,
    objetivo_nutricional TEXT NOT NULL,
    alergias TEXT,
    restricoes_alimentares TEXT,
    cintura DECIMAL(5, 2),
    quadril DECIMAL(5, 2),
    coxa DECIMAL(5, 2),
    braco DECIMAL(5, 2),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE
);

-- Criação da tabela automonitoramento
CREATE TABLE automonitoramento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL, -- Relaciona ao usuário
    atividade_fisica BOOLEAN NOT NULL,    -- True para se exercitou, False para não
    hidratacao BOOLEAN NOT NULL,          -- True para bateu a meta, False para não
    intestino BOOLEAN NOT NULL,           -- True para funcionou, False para não
    descanso ENUM('bom', 'ruim') NOT NULL, -- Avaliação do descanso
    plano_cafe ENUM('seguiu o plano', 'refeição livre', 'pulou') NOT NULL,
    plano_colacao ENUM('seguiu o plano', 'refeição livre', 'pulou') NOT NULL,
    plano_almoco ENUM('seguiu o plano', 'refeição livre', 'pulou') NOT NULL,
    plano_lanche ENUM('seguiu o plano', 'refeição livre', 'pulou') NOT NULL,
    plano_jantar ENUM('seguiu o plano', 'refeição livre', 'pulou') NOT NULL,
    plano_ceia ENUM('seguiu o plano', 'refeição livre', 'pulou') NOT NULL,
    data_monitoramento DATE NOT NULL,      -- Data do automonitoramento
    FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE
);

-- Criação da tabela dieta_padrao
CREATE TABLE dieta_padrao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao TEXT NOT NULL,
    peso_min DECIMAL(5, 2) NOT NULL,
    peso_max DECIMAL(5, 2) NOT NULL
);

-- Criação da tabela dieta_usuario
CREATE TABLE dieta_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_dieta_padrao INT NOT NULL,
    data_geracao DATE NOT NULL DEFAULT CURRENT_DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE,
    FOREIGN KEY (id_dieta_padrao) REFERENCES dieta_padrao(id) ON DELETE CASCADE
);

-- Criação da tabela agendamento
CREATE TABLE agendamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    data_consulta DATE NOT NULL,
    horario TIME NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE,
    UNIQUE (data_consulta, horario)
);

-- Inserção de dietas padrão
INSERT INTO dieta_padrao (descricao, peso_min, peso_max) VALUES
-- Dieta para manutenção de peso
('
    <h3>Café da manhã:</h3>
    <p>Refeição rica em fibras, proteínas e carboidratos complexos, como ovos, aveia e frutas. A ideia é começar o dia com energia, sem exageros.</p>
    <h3>Colação:</h3>
    <p>Lanche intermediário com opções leves, como frutas, castanhas ou iogurte. Ajuda a manter os níveis de energia até o almoço.</p>
    <h3>Almoço:</h3>
    <p>Refeição equilibrada com proteínas magras, vegetais e carboidratos complexos, como peito de frango, arroz integral e salada. Foco no equilíbrio.</p>
    <h3>Lanche:</h3>
    <p>Uma refeição leve, como barras de proteína ou queijo cottage, para evitar a fome até o jantar.</p>
    <h3>Jantar:</h3>
    <p>Uma refeição mais leve, com proteínas magras e vegetais. Exemplo: peixe grelhado, brócolis e quinoa.</p>
    <h3>Ceia:</h3>
    <p>Refeição opcional para sustentar o corpo durante a noite, como caseína ou abacate.</p>
', 0.0, 70.0),

-- Dieta para perda de peso
('
    <h3>Café da manhã:</h3>
    <p>Refeição com proteínas magras e baixo carboidrato, como ovos mexidos e café preto sem açúcar.</p>
    <h3>Colação:</h3>
    <p>Frutas frescas, que são leves e ajudam a controlar a fome até o almoço.</p>
    <h3>Almoço:</h3>
    <p>Proteínas magras, vegetais e uma pequena porção de carboidrato complexo, como frango grelhado e salada.</p>
    <h3>Lanche:</h3>
    <p>Opções de baixo carboidrato, como castanhas ou iogurte grego sem açúcar.</p>
    <h3>Jantar:</h3>
    <p>Uma refeição leve, com proteínas e vegetais, sem carboidratos simples, para facilitar a digestão.</p>
    <h3>Ceia:</h3>
    <p>Refeição opcional, que pode ser substituída por uma infusão de ervas ou água com limão.</p>
', 70.1, 90.0), 

-- Dieta para ganho de massa muscular
('
    <h3>Café da manhã:</h3>
    <p>Refeição rica em proteínas e carboidratos, como ovos mexidos, pão integral e frutas frescas. Essencial para iniciar o dia com energia.</p>
    <h3>Colação:</h3>
    <p>Lanche com boas fontes de proteína, como iogurte grego e granola sem açúcar.</p>
    <h3>Almoço:</h3>
    <p>Refeição robusta, com proteínas de alta qualidade, carboidratos complexos e vegetais. Exemplo: carne magra, arroz integral e brócolis.</p>
    <h3>Lanche:</h3>
    <p>Opção com proteínas e carboidratos, como barras de proteína ou sanduíche de pão integral com frango.</p>
    <h3>Jantar:</h3>
    <p>Refeição leve, mas nutritiva, com peixe ou frango grelhado e vegetais. Exemplo: tilápia com batata doce e espinafre.</p>
    <h3>Ceia:</h3>
    <p>Alimentos ricos em proteína, como caseína ou um smoothie de proteína.</p>
', 90.1, 999.99);
