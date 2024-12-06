<h1>Formulario de Compra</h1>
<form method="POST" action="index.php?page=Cart-CartForm">
    <label for="details">Detalles:</label><br>
    <textarea id="details" name="details" rows="4" cols="50"></textarea><br><br>
    <label for="total">Total:</label><br>
    <input type="number" id="total" name="total" step="0.01" required><br><br>
    <label for="payments">Método de Pago:</label><br>
    <textarea id="payments" name="payments" rows="4" cols="50"></textarea><br><br>
    <button type="submit">Finalizar Compra</button>
</form>

{{if success}}
    <div class="success">{{success}}</div>
{{endif success}}
{{if error}}
    <div class="error">{{error}}</div>
{{endif error}}
