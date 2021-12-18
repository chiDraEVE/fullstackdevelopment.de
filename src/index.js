import("../sass/style.scss")
import("../sass/style-dark-mode.scss")

import axios from "axios"

async function getTitle() {
	try {
		const res = await axios.get("http://localhost/wp-unit-test/?rest_route=/")
		// const data = await JSON.parse(res);
		console.log(res.data.name)
		console.log("blub")
	} catch (e) {
		console.error(e)
	}
}

getTitle()
