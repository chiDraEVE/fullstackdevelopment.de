import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { layout = 'card' } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title="Layout">
					<SelectControl
						label="Layout"
						value={ layout }
						options={ [
							{ label: 'Karte', value: 'card' },
							{ label: 'Voll', value: 'full' },
						] }
						onChange={ ( value ) => setAttributes( { layout: value } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps() }>
				<div className="fsd-author-card__placeholder">
					<strong>Instructor Card</strong>
					<div>Platzhalter im Editor (Frontend wird per PHP gerendert)</div>
					<div>Layout: { layout }</div>
				</div>
			</div>
		</>
	);
}
