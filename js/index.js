import("../sass/style.scss")

import axios from "axios"

async function getTitle() {
	try {
		const res = await axios.get(
			"http://localhost/wp-unit-test/index.php/wp-json/"
		)
		// const data = await JSON.parse(res);
		console.log(res.data.name)
	} catch (e) {
		console.error(e)
	}
}

getTitle()
