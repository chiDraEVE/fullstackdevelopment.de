wp.blocks.registerBlockType("ourblocktheme/footer", {
	title: "Fictional University Footer",
	edit: function () {
		return wp.element.createElement("div", {className: "our-placeholder-block"}, "Fictional University Footer" +
			" Placeholder")
	},
	save: function () {
		return null
	}
})