<?php

class ClienteController extends Controller
{

    public function index()
    {
        return;
    }

    private static function formVerify()
    {
        foreach ($_POST as $key => $value) {
            $$key = trim(strip_tags($value));

            if (empty($value)) {
                throw new Exception("Erro: Todos os campos devem ser preenchidos.");
            }
        }

        if (!is_numeric($_POST['inputCnpj'])) {
            throw new Exception("Erro: Campo CNPJ deve conter apenas numeros.");
        } else if (!is_numeric($_POST['inputTelefone']) && $_POST['inputCep'] > 0) {
            throw new Exception("Erro: Campo Telefone deve conter apenas numeros.");
        } else if (!is_numeric($_POST['inputCep']) && $_POST['inputCep'] > 0) {
            throw new Exception("Erro: Campo Cep deve conter apenas numeros.");
        } else if (!is_numeric($_POST['inputNumero']) && $_POST['inputNumero'] > 0) {
            throw new Exception("Erro: Campo Numero deve conter apenas numeros.");
        }
    }

    public function create()
    {

        self::formVerify();

        Cliente::create(
            new Cliente(
                $_POST["inputNome"],
                $_POST['inputSobrenome'],
                $_POST['inputCnpj'],
                $_POST['inputTelefone'],
                strval(date("dd-mm-yy")),
                new Endereco(
                    $_POST['inputEstado'],
                    $_POST['inputCidade'],
                    $_POST['inputBairro'],
                    $_POST['inputRua'],
                    intval($_POST['inputCep']),
                    intval($_POST['inputNumero'])
                )
            )
        );

        $_SESSION['msg'] = [
            'type' => 'success',
            'content' => "Cliente cadastrado com sucesso!"
        ];

        header('Location: /');
    }

    public function update($param = [])
    {
        $data = [
            'page_title' => 'Portaria',
            'title' => 'Sistema de Portaria',
            'box_title' => 'Alteração',
            'clients' => Cliente::selectAll(),
            'action' => "update"
        ];

        if (isset($param['id']) && !empty($param['id']) && !isset($_POST['save'])) {
            $data['cliente'] = Cliente::selectOne($param['id']);
        } else {

            if (!is_numeric($_POST['save'])) {
                throw new Exception("Erro: Campo CNPJ deve conter apenas numeros.");
            }

            $param['id'] = $_POST['save'];
            unset($_POST['save']);
            self::formVerify();
            Cliente::update(
                new Cliente(
                    $_POST["inputNome"],
                    $_POST['inputSobrenome'],
                    $_POST['inputCnpj'],
                    $_POST['inputTelefone'],
                    strval(date("dd-mm-yy")),
                    new Endereco(
                        $_POST['inputEstado'],
                        $_POST['inputCidade'],
                        $_POST['inputBairro'],
                        $_POST['inputRua'],
                        intval($_POST['inputCep']),
                        intval($_POST['inputNumero'])
                    ),
                    intval($param['id'])
                )
            );
            $data['msg'] = [
                'type' => 'success',
                'content' => "Cliente alterado com sucesso!"
            ];
        }

        $this->view('Layout', $data);
    }

    public function delete($param = [])
    {
        if (isset($param['id']) && !empty($param['id'])) {
            $data['cliente'] = Cliente::delete($param['id']);
        } else {
            throw new Exception("Não foi possível deletar este cliente.");
        }

        header("location: /");
    }
}
