export default class PrincipalControlador
{
    static index(req, res, next){
		res.render('template/index');
	}

	static resultados(req, res, next){
		let query = req.input.query //$request->input('query');
		let data = Principal.parametros('resultados', query);
		data['query'] = query;
		
		res.render('template/empty', data);
	}
}