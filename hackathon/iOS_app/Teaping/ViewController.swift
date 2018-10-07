//
//  ViewController.swift
//  Teaping
//
//  Created by Małgorzata Dziubich on 06/10/2018.
//  Copyright © 2018 GGC. All rights reserved.
//

import UIKit

final class ViewController: UIViewController {

    @IBOutlet weak var textField: CurrencyField!

    @IBOutlet weak var actionButtton: UIButton!

    private let viewModel: ViewModel = ViewModel()

    override func viewDidLoad() {
        super.viewDidLoad()
        view.backgroundColor = .white

        let tap = UITapGestureRecognizer(target: self, action: #selector(dismissKeyboard))
        view.addGestureRecognizer(tap)

        textField.textAlignment = .center
        drawShdow(on: actionButtton)
        drawShdow(on: textField)
        actionButtton.layer.cornerRadius = actionButtton.frame.height / 2
    }

    @IBAction func giveATip(_ sender: Any) {
        guard let amount = textField.text,
            !amount.isEmpty,
            let amountInt = viewModel.formatAmount(from: amount),
            amountInt != 0 else {
                return
        }
        viewModel.amount = amountInt

        let addCardViewController = STPAddCardViewController()
        let nc = UINavigationController(rootViewController: addCardViewController)
        addCardViewController.delegate = self
        present(nc, animated: true, completion: nil)
    }

    @objc private func dismissKeyboard() {
        textField.endEditing(true)
    }

    func drawShdow(on view: UIView) {
        view.layer.shadowColor = UIColor.gray.cgColor
        view.layer.shadowOpacity = 1
        view.layer.shadowOffset = CGSize.zero
        view.layer.shadowRadius = 7
    }
}

extension ViewController: STPAddCardViewControllerDelegate {

    func addCardViewControllerDidCancel(_ addCardViewController: STPAddCardViewController) {
        addCardViewController.dismiss(animated: true, completion: nil)
    }

    func addCardViewController(_ addCardViewController: STPAddCardViewController,
                               didCreateToken token: STPToken,
                               completion: @escaping STPErrorBlock) {

        viewModel.completeCharge(with: token) { [weak self] result in
            switch result {
            case .success:
                completion(nil)
                guard let vc = self?.storyboard?
                    .instantiateViewController(withIdentifier: "SuccessViewController") else {
                        addCardViewController.dismiss(animated: true, completion: nil)
                        return
                }

                addCardViewController.navigationController?.setViewControllers([vc], animated: true)
                self?.textField.text = "$0"
                self?.dismissResult(vc)
            case .failure(let error):
                completion(error)
            }
        }
    }

    private func presentSuccess() {
        guard let vc = storyboard?
            .instantiateViewController(withIdentifier: "SuccessViewController") else {
            return
        }
        present(vc, animated: true, completion: nil)
    }

    private func dismissResult(_ vc: UIViewController) {
        DispatchQueue.main.asyncAfter(deadline: .now() + 2) {
            vc.dismiss(animated: true)
        }
    }
}
