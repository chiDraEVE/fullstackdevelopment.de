import "./neon.css";
import { registerFormatType, toggleFormat } from "@wordpress/rich-text";
import { RichTextToolbarButton } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { useSelect } from "@wordpress/data";

registerFormatType("udemy-plus/neon", {
  title: __("Neon", "udemy-plus"),
  tagName: "span",
  className: "neon",
  edit({ isActive, onChange, value }) {
    const selectedBlock = useSelect((select) =>
      select("core/block-editor").getSelectedBlock()
    );

    return (
      <>
        {selectedBlock?.name === "core/paragraph" && (
          <RichTextToolbarButton
            title={__("Neon", "udemy-plus")}
            icon="superhero"
            isActive={isActive}
            onClick={() => {
              onChange(
                toggleFormat(value, {
                  type: "udemy-plus/neon",
                })
              );
            }}
          />
        )}
      </>
    );
  },
});
