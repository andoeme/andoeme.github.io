//
//  DateTextField.swift
//  Teaping
//
//  Created by Małgorzata Dziubich on 06/10/2018.
//  Copyright © 2018 GGC. All rights reserved.
//

import Foundation

final class DateTextField: UITextField {

    private var string: String {
        return text ?? ""
    }

    override init(frame: CGRect) {
        super.init(frame: frame)
        addTarget(self, action: #selector(textFieldDidChange), for: .editingChanged)
        keyboardType = .numberPad
    }

    @available(*, unavailable)
    required convenience public init?(coder aDecoder: NSCoder) {
        self.init()
    }

    @objc private func textFieldDidChange() {
        if string.count == 2 {
            text = string + "/"
        }
    }
}
